<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Member;

class Members extends Component
{
    public $members, $nama, $nickname, $gender, $telp, $status, $member_id;
    public $isModal;

    public function render()
    {
        $this -> members = Member::orderBy('created_at','DESC')->get();
        return view('livewire.members');
    }

    public function create()
    {
        $this->resetFields();

        $this->openModal();
    }

    public function resetFields()
    {
        $this->nama = '';
        $this->nickname= '';
        $this->gender = '';
        $this->telp = '';
        $this->status = '';
        $this->member_id = '';
    }

    public function openModal()
    {
        $this->isModal = true;
    }

    public function closeModal()
    {
        $this->isModal = false;
    }

     //METHOD STORE AKAN MENG-HANDLE FUNGSI UNTUK MENYIMPAN / UPDATE DATA
    public function store()
    {
        //MEMBUAT VALIDASI
        $this->validate([
            'nama' => 'required|string',
            'nickname' => 'required|string',
            'gender' => 'required',
            'telp' => 'required|numeric',
            'status' => 'required'
        ]);


          //QUERY UNTUK MENYIMPAN / MEMPERBAHARUI DATA MENGGUNAKAN UPDATEORCREATE
        //DIMANA ID MENJADI UNIQUE ID, JIKA IDNYA TERSEDIA, MAKA UPDATE DATANYA
        //JIKA TIDAK, MAKA TAMBAHKAN DATA BARU
        Member::updateOrCreate(
            ['id' => $this->member_id],
            [
            'nama' => $this->nama,
            'nickname' => $this->nickname,
            'gender' => $this->gender,
            'telp' => $this->telp,
            'status' => $this->status,
            ]
        );

        session()->flash('message', $this->member_id ? $this->nama . ' Diperbaharui': $this->nama . ' Ditambahkan');
        $this->closeModal(); //TUTUP MODAL
        $this->resetFields(); //DAN BERSIHKAN FIELD

    }

    public function edit($id)
    {
        $member = Member::find($id); //BUAT QUERY UTK PENGAMBILAN DATA
        //LALU ASSIGN KE DALAM MASING-MASING PROPERTI DATANYA
        $this->member_id = $id;
        $this->nama = $member->nama;
        $this->nickname = $member->nickname;
        $this->gender = $member->gender;
        $this->telp = $member->telp;
        $this->status = $member->status;

        $this->openModal(); //LALU BUKA MODAL
    }

    //FUNGSI INI UNTUK MENGHAPUS DATA
    public function delete($id)
    {
        $member = Member::find($id); //BUAT QUERY UNTUK MENGAMBIL DATA BERDASARKAN ID
        $member->delete(); //LALU HAPUS DATA
        session()->flash('message', $member->nama . 'Dihapus'); //DAN BUAT FLASH MESSAGE UNTUK NOTIFIKASI
    }
}
