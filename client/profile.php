<!DOCTYPE html>
<html>
  <?php require_once ('includes/head.inc.php')?>
  <body>
    <?php include_once ('includes/nav.inc.php')?>
    <!-- Main -->
    <div class="row my-2">    
            <div class="tab-content py-4">
                <div class="tab-pane active" id="profile">
                    <h5 class="mb-3">User name</h5>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Name</label>
                                <div class="col-lg-9">
                                    <span>{{ Auth::user()->name }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Email</label>
                                <div class="col-lg-9">
                                    <span>{{ Auth::user()->email }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Username</label>
                                <div class="col-lg-9">
                                    <span>{{ Auth::user()->name }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="quiz">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Quiz</th>
                            <th>Score</th>
                            <th>Number of Items</th>
                            <th>Percentage</th>
                            <th>Date Taken</th>
                        </tr>
                        </thead>
                    </table>
                </div>
                <div class="tab-pane" id="edit">
                    <form role="form">
                        @csrf
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Name</label>
                            <div class="col-lg-9">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                       name="name" value="{{ Auth::user()->name }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Email</label>
                            <div class="col-lg-9">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                       name="email" value="{{ Auth::user()->email }}"
                                       required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Username</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" value="{{ Auth::user()->name }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Password</label>
                            <div class="col-lg-9">
                                <input id="password" type="password"
                                       class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                                       placeholder="Password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Confirm password</label>
                            <div class="col-lg-9">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                                       placeholder="Confirm Password" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label"></label>
                            <div class="col-lg-9">
                                <input type="reset" class="btn btn-secondary" value="Cancel">
                                <input type="button" class="btn btn-primary" value="Save Changes">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4 order-lg-1 text-center">
            <img src="//placehold.it/150" class="mx-auto img-fluid img-circle d-block" alt="avatar">
            <h6 class="mt-2">Upload a different photo</h6>
            <label class="custom-file">
                <input type="file" id="file" class="custom-file-input">
                <span class="btn">Choose file</span>
            </label>
        </div>
<?php include_once ('includes/footer.inc.php')?>
</body>
</html>