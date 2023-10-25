  <div class="card blurry_white_bg border-radius-25">
    <div class="card-header text-center bg-transparent">
      <h2 class="font-22">Book Your Free Session</h2>
      <p class="font-14">Learn from India's Smart Teachers</p>
    </div>
    <div class="card-body">
      <form method="post" action="/cms/leads/store">
      @csrf
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Your Name" name="name" />
          @if ($errors->has('name'))
            <p class="text-danger">{{ $errors->first('name') }}</p>
          @endif
        </div>
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Mobile" name="mobile" maxlength="10" />
          @if ($errors->has('mobile'))
            <p class="text-danger">{{ $errors->first('mobile') }}</p>
          @endif
        </div>
        <div class="form-group">
          <input type="email" class="form-control" placeholder="Email" name="email" />
          @if ($errors->has('email'))
            <p class="text-danger">{{ $errors->first('email') }}</p>
          @endif
        </div>
        <div class="form-group">
          <select class="form-control" name="course_interested">
            <option value="0">Select Course</option>
            <option value="Course 1">Course 1</option>
            <option value="Course 2">Course 2</option>
          </select>
          @if ($errors->has('course_interested'))
            <p class="text-danger">{{ $errors->first('course_interested') }}</p>
          @endif
        </div>
        <div class="form-group">
          <input type="submit" class="btn btn-theme-contrast w-100" value="Book Free Session" />
        </div>
      </form>
    </div>
  </div>