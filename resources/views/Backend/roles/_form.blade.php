@csrf
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="form-group">
    <label for="name">Name</label>
    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
           value="{{old('name',$role->name)}}">
    @error('name')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="description">Description</label>
    <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="5"
              >{{old('description',$role->description)}}</textarea>
    @error('description')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>




<div class="form-group mt-4">
    <button type="submit" class="btn btn-primary">{{$btnTxt}}</button>
</div>
