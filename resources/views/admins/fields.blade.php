<form  action="{{ route('user.store') }}" class="forms-sample" method="POST">
    @csrf
    <div class="form-group">
        <label for="exampleInputName1">Name</label>
        <input type="text" name="name" value="{{ isset($users) ? $users->name : '' }}" class="form-control" id="exampleInputName1" placeholder="Name">
        @if (isset($users))
        <input type="hidden" name="user_id" value="{{ $users->id }}">
        @endif
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleInputEmail3">Email address</label>
                <input type="email" name="email" value="{{ isset($users) ? $users->email : '' }}" class="form-control" id="exampleInputEmail3" placeholder="Email">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleSelectGender">Gender</label>
                <select class="form-control" id="exampleSelectGender">
                    <option>Male</option>
                    <option>Female</option>
                </select>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword4">Password</label>
        <input type="password" name="password" value="{{ isset($users) ? $users->password : '' }}" class="form-control" id="exampleInputPassword4" placeholder="Password">
    </div>
    <button type="submit" class="btn btn-primary mr-2">Submit</button>
    <button class="btn btn-light">Cancel</button>
</form>
