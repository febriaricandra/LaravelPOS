@foreach ($barang as $item)
    <tr>
        <td>{{ $item->id }}</td>
        <td>{{ $item->nama_barang }}</td>
        <td>-</td>
        <td>{{ $item->harga_jual }}</td>
        <td>{{ $item->stok }}</td>
        <td>{{ $item->keterangan }}</td>
        <td>
            <a href="" class="btn btn-primary">Edit</a>
            <form action="" method="POST" style="display: inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </td>
    </tr>
    @if ($barang->isEmpty())
        <tr>
            <td colspan="7" class="text-center">Tidak ada data</td>
        </tr>
    @endif
@endforeach
