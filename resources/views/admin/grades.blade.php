@extends('layouts.app')

@section('content')
    @include('admin.modals')

    <div class="container">
        <div class="row justify-content-center">

            @include('admin.menu')

            <div class="col-md-8">
                <div class="card">
                    <div class="adminContent" style="display: block;">
                        <span class="upperLeft">
                            <label for="perPageSel">На страница по:</label>
                            <select id="perPageSel" onchange="applyPerPage(this, 'grades')">
                                <option value="5" @if($perPage == 5) selected @endif>5</option>
                                <option value="10" @if($perPage == 10) selected @endif>10</option>
                                <option value="25" @if($perPage == 25) selected @endif>25</option>
                                <option value="50" @if($perPage == 50) selected @endif>50</option>
                                <option value="100" @if($perPage == 100) selected @endif>100</option>
                            </select>
                        </span>

                        <span class="upperRight">
                            <button onclick="location.href = '/admin/grades/create';" type="button" class="btn btn-success">Добави <i class="icon-plus"></i></button>
                        </span>
                        <h3>Класове:</h3>

                        <ul class="adminList">
                            @php $count = 1; @endphp
                            @foreach($data as $row)
                                <li>
                                    {{ $count }}. <span><b> {{ $row['title'] }}</b>, {{ $row['schoolTitle'] }}</span>
                                    <button onclick="location.href = '/admin/grade/'+{{ $row['id'] }};"><i class="icon-pencil"></i></button>
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
