@extends('cms.layouts.master')
@section('body')
  <div class="row my-3">
    <div class="col-12 col-lg-6"><h1>Add Menus</h1></div>
    <div class="col-12 col-lg-6 text-right"><a href="/cms/menus" class="btn btn-lg btn-secondary">View Menus</a></div>
  </div>


  <form class="card" method="post" action="/cms/menus/store">
    @csrf
    <div class="card-body">
      <div class="row form-group">
        <div class="col-lg-4">
          <label class="font-weight-bold">Menu Name</label>
          <input type="text" id="title" onkeyup="CreateAndSetSlug()" class="form-control" name="name" placeholder="menu Name" />
          @if ($errors->has('name'))
            <p class="text-danger">{{ $errors->first('name') }}</p>
          @endif
        </div>
        <div class="col-lg-4">
          <label class="font-weight-bold">menu Slug</label>
          <input type="text" class="form-control" name="slug" placeholder="menu slug"  />
          @if ($errors->has('slug'))
            <p class="text-danger">{{ $errors->first('slug') }}</p>
          @endif
        </div>
        <div class="col-lg-4 align-self-center">
          <label class="font-weight-bold mb-0">Lead Status</label>
          <select name="status" class="form-control">
            <option>Active</option>
            <option>Deactive</option>
          </select>
        </div>
      </div>
    </div>
    <div class="card-body">
      <div class="row form-group">
        <div class="col-lg-12">
          <div class="accordion" id="accordionExample">
            <div class="card" id="card1">
              <div class="card-header" id="headingOne">
                <h2 class="mb-0 d-flex justify-content-between">
                  <div class="align-self-center flex-fill">
                    <button class="btn font-weight-bold" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      Item#1
                    </button>
                  </div>
                  <div class="align-self-center">
                    <a class="btn btn-danger delete-card" data-card-id="card1" href="javascript:void(0);"><i class="bi bi-trash"></i></a>
                  </div>
                </h2>
              </div>
              <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                  <div class="row form-group">
                    <div class="col-lg-4">
                      <label class="font-weight-bold">Item Title</label>
                      <input type="text" class="form-control" name="title[]" placeholder="Item Title" />
                      @if ($errors->has('name'))
                        <p class="text-danger">{{ $errors->first('title') }}</p>
                      @endif
                    </div>
                    <div class="col-lg-4">
                      <label class="font-weight-bold">Link</label>
                      <input type="text" class="form-control" name="link[]" placeholder="Item Link"  />
                      @if ($errors->has('slug'))
                        <p class="text-danger">{{ $errors->first('link') }}</p>
                      @endif
                    </div>
                    <div class="col-lg-4">
                      <label class="font-weight-bold">Icon</label>
                      <input type="text" class="form-control" name="icon[]" placeholder="Icon Class"  />
                      @if ($errors->has('slug'))
                        <p class="text-danger">{{ $errors->first('icon') }}</p>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card-footer">
      <div class="row">
        <div class="col-6 text-left">
          <input type="submit" class="btn btn-lg btn-primary" value="Submit" />
        </div>
        <div class="col-6 text-right">
          <button type="button" onclick="addMore();" class="btn btn-lg btn-warning"><i class="bi bi-node-plus mr-2"></i> Add More</button>
        </div>
      </div>
    </div>
  </form>

  <script>
        var count = 2; // Initialize count for dynamically generated fields (assuming you already have one card)

        // Add More button click event
       function addMore() {
            var newCard = $('#accordionExample .card:first').clone();
            var cardId = 'card' + count;
            newCard.attr('id', cardId);
            // Update the card's ID and button attributes
            newCard.find('.card-header').attr('id', 'heading' + count);
            newCard.find('button').attr({
                'data-target': '#collapse' + count,
                'aria-controls': 'collapse' + count,
            });
            newCard.find('button').text("Item#"+count);
            newCard.find('a').attr({
                'data-card-id': cardId
            });
            // Update the collapse div's ID and input names
            newCard.find('.card-body').attr('id', 'collapse' + count);
            newCard.find('input[name="title[]"]').attr('name', 'title[]');
            newCard.find('input[name="link[]"]').attr('name', 'link[]');
            newCard.find('input[name="icon[]"]').attr('name', 'icon[]');

            // Reset input values
            newCard.find('input').val('');

            // Append the new card to the accordion
            $('#accordionExample').append(newCard);
            $('#accordionExample').on('click', '.delete-card', function() {
            var cardId = $(this).data('card-id');
            $('#' + cardId).remove();
        });
            // Increment the count
            count++;
        }
        $('#accordionExample').on('click', '.delete-card', function() {
            var cardId = $(this).data('card-id');
            $('#' + cardId).remove();
        });   
</script>  
@stop