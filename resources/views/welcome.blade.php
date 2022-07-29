@extends('Backend.master')
@section('content')
<h1>asdsa</h1>
<input type="file" class="my-pond" id="avatar" name="avatar"/>

<!-- include jQuery library -->

<!-- include FilePond library -->


<script>
    const inputElement = document.querySelector("input[id ='avatar']");
    const pond = FilePond.create(inputElement);
</script>

@endsection
