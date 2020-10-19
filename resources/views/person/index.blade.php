@extends('layout.app')
@section('content')
<!-- Begin page content -->
<main role="main" class="container mt-5">
    <h1 class="mt-5">Person page</h1>
    <p class="lead">Juste a page to show the person table</p>
    <table class="table">
        <tr>
            <td>
               <b> id </b>
            </td>
            <td>
               <b> nickname </b>
            </td>
            <td>
               <b> age </b>
            </td>
        </tr>
        @foreach ($person as $per)
         <tr>
            <td>
                {{$per->id}}
            </td>
            <td>
                {{$per->nickname}}
            </td>
             <td>
                {{$per->age}}
            </td>
        </tr>
        @endforeach
    </table>
</main>
@endsection
