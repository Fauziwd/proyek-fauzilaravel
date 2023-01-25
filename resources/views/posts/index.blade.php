@extends('layout.admin')
@section('content')

<div class="p-4 shadow-lg p-3 mb-5 rounded flex-container;" style="background: rgb(58, 67, 134);
background: linear-gradient(211deg, rgb(58, 76, 134) 0%, rgb(88, 93, 164) 36%, rgb(174, 190, 255) 100%); color: #061a44; margin: 40px;">
<h4 style="text-align: center;">Post Data</h4>
</div>
<div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <a href="{{ route('posts.create') }}" class="btn btn-md btn-success mb-3 shadow rounded">TAMBAH DATA</a>
                        <table class="table table-bordered; rounded;" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);">
                              <tr style="background: rgb(58, 68, 134);
                              background: linear-gradient(211deg, rgb(58, 76, 134) 0%, rgb(88, 93, 164) 36%, rgb(174, 190, 255) 100%); color: #061a44; margin: 40px;">
                                <th scope="col">Nomor Induk</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Email</th>
                                <th scope="col">Nomor Hp</th>
                                <th scope="col">Foto</th>
                                <th scope="col">Option</th>
                              </tr>
                            </thead>
                            <tbody>
                              @forelse ($posts as $post)
                                <tr>
                                    <td style="text-align: center;">{{ $post->number }}</td>
                                    <td>{{ $post->name }}</td>
                                    <td>{{ $post->email }}</td>
                                    <td>{{ $post->phone}}</td>
                                    <td class="text-center">
                                        <img src="{{ Storage::url('public/posts/').$post->image }}" class="rounded" style="width: 80px">
                                    </td>
                     
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-primary" style="width:100%;">EDIT</a><br><br>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" style="width:100%;">HAPUS</button>
                                        </form>
                                    </td>
                                </tr>
                              @empty
                                  <div class="alert alert-danger">
                                      Data post belum Tersedia.
                                  </div>
                              @endforelse
                            </tbody>
                          </table>  
                          {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        //message with toastr
        @if(session()->has('success'))
        
            toastr.success('{{ session('success') }}', 'BERHASIL!'); 

        @elseif(session()->has('error'))

            toastr.error('{{ session('error') }}', 'GAGAL!'); 
            
        @endif
    </script>
    @stop