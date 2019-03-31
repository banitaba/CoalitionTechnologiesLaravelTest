@extends('layouts.dashboard')
@section('sideBar')
    <ul class="sidebar navbar-nav">
            <li class="nav-item active">
            <a class="nav-link" href="/">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="/products">
                <i class="fas fa-fw fa-table"></i>
                <span>Products</span></a>
            </li>
        </ul>
@endsection
@section('content')
    <div id="content-wrapper">
        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Products</a>
            </li>
            <li class="breadcrumb-item active">Overview</li>
          </ol>
          <!-- End Breadcrumbs-->
          <form id="product_form">
              <div class="form-group">
                <label for="product_name">Product Name</label>
                <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Product Name" required>
              </div>
              <div class="form-row">
                  <div class="form-group col-md-4">
                    <label for="quantity_in_stock">Quantity In Stock</label>
                    <input type="number" class="form-control" id="quantity_in_stock" name="quantity_in_stock" placeholder="Numeric" required>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="price_per_item">Price Per Item</label>
                    <input type="number" step="0.01" class="form-control" id="price_per_item" name="price_per_item" placeholder="Numeric" required>
                  </div>  
              </div>
              <div class="form-group">
                    <button type="submit" id='submit_but'class="btn btn-primary">Submit</button>                    
              </div>
          </form>

          <!-- Area content Example-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Products Table</div>
            <div class="card-body">

              <!-- Showing Product TAble-->
              <div id="product-table"></div>
           

            </div>
            <div class="card-footer small text-muted"> Use the pagination controls</div>
          </div>
        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <footer class="sticky-footer">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright © Hossein Banitaba 2019</span>
            </div>
          </div>
        </footer>
    </div>

<script>
   //define some sample data
   var tabledata ={!! $tableData !!}; 
</script>
<!-- JQuery -->
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<!-- Tabulator UNPKG -->     
<script type="text/javascript" src="https://unpkg.com/tabulator-tables@4.2.3/dist/js/tabulator.min.js"></script>
    
<script>

    var table = new Tabulator("#product-table", {
      data:tabledata,           //load row data from array
      layout:"fitColumns",      //fit columns to width of table
      responsiveLayout:"hide",  //hide columns that dont fit on the table
      tooltips:true,            //show tool tips on cells
      addRowPos:"top",          //when adding a new row, add it to the top of the table
      history:true,             //allow undo and redo actions on the table
      pagination:"local",       //paginate the data
      paginationSize:7,         //allow 7 rows per page of data
      movableColumns:true,      //allow column order to be changed
      resizableRows:true,       //allow row order to be changed
      initialSort:[             //set the initial sort order of the data
        {column:"id",  dir:"desc"},
      ],
      columns:[                 //define the table columns
        {title:"Id", field:"id", editor:false,align:"center",width:13},
        {title:"Product Name", field:"product_name", editor:false,  widthGrow:3 },
        {title:"Quantity In Stock", field:"quantity_in_stock", width:160, sorter:"number", align:"center", editor:false},
        {title:"Price Per Item", field:"price_per_item", width:135, sorter:"number", align:"center", editor:false},
        {title:"Created At", field:"created_at", width:130, sorter:"date",sorterParams:{
          format:"MM/DD/YYYY",
          alignEmptyValues:"top",
      } ,align:"center"},
        {title:"Updated At", field:"updated_at", width:130, sorter:"date", sorterParams:{
          format:"MM/DD/YYYY",
          alignEmptyValues:"top",
      } , align:"center"},
      ],
    }); 
</script>

<script>
  // Ajax call
 
  jQuery(document).ready(function() {
    jQuery('#product_form').submit(function(e) {
        save_product();
    });
     //$('#submit_but').click(function(e) {
     // event.preventDefault();
     // save_product();
     // });

  });
  const xCsrfToken = "{{ csrf_token() }}";
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': xCsrfToken
    }
  });
  
  var save_product = function() {
   console.log('inside save_product');
    var data_string = $("#product_form").serialize();
    console.log(data_string);
    $.ajax({
        type: 'post',
        url: '/product_save?'+data_string,
        dataType: 'JSON', //Make sure your returning data type dffine as json
        data: {
          _token:xCsrfToken,    
        },
        success: function(data) {
            console.log(data); //Please share cosnole data
        }
    });
  }
 </script>

@endsection