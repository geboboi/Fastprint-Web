<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Status;

class GetProduk extends Command
{
    protected $signature = 'produk:fetch';
    protected $description = 'Mengambil data produk dari API FastPrint';

    public function handle()
    {
        date_default_timezone_set('Asia/Jakarta');
        
        $username = 'tesprogrammer300126C00'; 
        
        $tanggal = date('d-m-y'); 
        $passwordString = "bisacoding-" . $tanggal;
        $password = md5($passwordString);

        $this->info("Menghubungkan ke API dengan User: $username");

        try {
            $response = Http::withHeaders([
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)', 
            ])->asForm()->post('https://recruitment.fastprint.co.id/tes/api_tes_programmer', [
                'username' => $username,
                'password' => $password,
                'status'   => '1'
            ]);

            if ($response->getStatusCode() !== 200) {
                $this->error('Gagal Koneksi! HTTP Status: ' . $response->getStatusCode());
                return;
            }

            $data = json_decode($response->getBody()->getContents(), true);

            // Cek Error dari API
            if (isset($data['error']) && $data['error'] != 0) {
                $this->error('API Error: ' . ($data['ket'] ?? 'Unknown'));
                return;
            }

            if (!isset($data['data']) || !is_array($data['data'])) {
                $this->error('Data kosong.');
                return;
            }

            $total = count($data['data']);
            $this->info("Login Sukses! Menyimpan $total produk ke database...");
            
            $bar = $this->output->createProgressBar($total);
            $bar->start();

            foreach ($data['data'] as $item) {
                $namaKategori = $item['kategori'] ?? 'Tanpa Kategori';
                $namaStatus = $item['status'] ?? 'Tanpa Status';
                $namaProduk = $item['nama_produk'] ?? 'Tanpa Nama';
                $hargaRaw = $item['harga'] ?? '0';

                $kategori = Kategori::firstOrCreate(['nama_kategori' => $namaKategori]);
                $status = Status::firstOrCreate(['nama_status' => $namaStatus]);
                
                $harga = preg_replace('/[^0-9]/', '', $hargaRaw);

                Produk::updateOrCreate(
                    ['id_produk' => $item['id_produk']],
                    [
                        'nama_produk' => $namaProduk,
                        'harga'       => (int) $harga,
                        'kategori_id' => $kategori->id_kategori,
                        'status_id'   => $status->id_status,
                    ]
                );
                $bar->advance();
            }

            $bar->finish();
            $this->newLine();
            $this->info('SELESAI! Cek browser Anda.');

        } catch (\Exception $e) {
            $this->error('Error System: ' . $e->getMessage());
        }
    }
}