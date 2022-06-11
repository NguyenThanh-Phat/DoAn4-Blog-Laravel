@if($errors->any())
<div class="alert alert-danger">
    <ui class="list-group">
        @foreach ($errors->all() as $error)
            <div class="list-group-item text-danger">
                {{ $error }}
            </div>
        @endforeach
    </ui>
</div>
@endif