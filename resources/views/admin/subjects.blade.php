@extends('layouts.app')

@section('content')
    @include('admin.modals')

    <div class="container">
        <div class="row justify-content-center">

            @include('admin.menu')

            <div class="col-md-8">
                <div class="card">
                    <div class="adminContent" style="display: block;">
                        <span class="upperRight">
                            <button onclick="modalCreate()" type="button" class="btn btn-success">Добави <i class="icon-plus"></i></button>
                        </span>
                        <h3>Предмети:</h3>

                        <ul class="adminList">
                            @php $count = 1; @endphp
                            @foreach($data as $row)
                                <li>
                                    {{ $count }}. <span>{{ $row['title'] }}</span>
                                    <button onclick="modalEdit($(this), {{ $row['id'] }})"><i class="icon-pencil"></i></button>
                                    <button onclick="modalDelete({{ $row['id'] }})"><i class="icon-close" style="color: red;"></i></button>
                                </li>
                                @php $count++; @endphp
                            @endforeach
                        </ul>

                        {{ $data->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
