<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Data Player</h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-8 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if (session()->has('message'))
                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md"  role="alert">
                    <div class="flex">
                        <div>
                            <p class="text-sm">{{ session('message')}}</p>
                        </div>
                    </div>
                </div>

            @endif

            {{-- tambah data --}}
            <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Tambah Member</button>

            @if ($isModal)

                @include('livewire.create')

            @endif



            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2">Nama</th>
                        <th class="px-4 py-2">Nickname</th>
                        <th class="px-4 py-2">Gender</th>
                        <th class="px-4 py-2">Telp</th>
                        <th class="px-4 py-2 w-20">Status</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($members as $member)
                        <tr>
                            <td class="border px-4 py-2">{{ $member->nama }}</td>
                            <td class="border px-4 py-2">{{ $member->nickname }}</td>
                            <td class="border px-4 py-2">{{ $member->gender }}</td>
                            <td class="border px-4 py-2">{{ $member->telp }}</td>
                            <td class="border px-4 py-2">{!!$member->status_label!!}</td>
                            <td class="border px-4 py-2">
                                {{-- edit&delet data --}}
                                <button wire:click="edit({{ $member->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button>
                                <button wire:click="delete({{ $member->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="border px-4 py-2 text-center" colspan="5">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
