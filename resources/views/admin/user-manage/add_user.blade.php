@include('include.admin_header');
<section>
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <h4>
          Add User
          @if (session('status'))
           <span style="float:right;color:green;" >  {{ session('status') }}</span>
          @endif
        </h4>
        <div class="card">
          <div class="card-header">
              <a href="/user-list"><button class="btn btn-warning"><i class="fa fa-arrow-left" ></i>&nbsp;Back</button></a>
          </div>
          <div class="card-body">
            <form method="POST" action="{{ route('add_user') }}">
                @csrf
                <div class="form-group">
                  <label>Role</label>
                  <select class="form-control"name="role" id="first" required>
                      <option disabled selected value="">--Select--</option>
                      <option value='1'>Admin</option>
                      <option value='0'>User</option>
                      <option value='2'>Representative</option>
                  </select>
              </div>

              <div class="form-group" style="display:none" id="university_name">
                <label>Name</label>
                <select class="form-control" name="university_id">
                    <option disabled selected value="">--Select--</option>
                    <option value='1'>All</option>
                    <option value='2'>Children</option>
                    <option value='3'>Disasters</option>
                    <option value='4'>Pandmic</option>
                </select>
             </div>

              <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" required>
              </div>

              <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
              </div>
              <div class="form-group">
                <label>IC</label>
                <input type="number" name="ic" class="form-control" required>
              </div>

              <div class="form-group">
                <label>Phone</label>
                <input type="number" name="phone" class="form-control" required>
              </div>
              <div class="form-group">
                <label>Address</label>
                <input type="text" name="address" class="form-control" required>
              </div>

              <div class="form-group">
                <label>Password</label>
                <input type="text" name="password" class="form-control" required>
              </div>
              <div class="form-group">
                <input type="submit" value="Add User" class="btn btn-primary">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script>
      $(document).ready(function(){
          $('#first').on('change', function () {
              if ($('#first').val() == '2') {
                //show the next dropdown
                $("#university_name").show();
              }else{
                //show the next dropdown
                $("#university_name").hide();
              }

          });

      });
  </script>
@include('include.admin_footer');
