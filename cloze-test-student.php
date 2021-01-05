<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8"/>
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
      <link type="text/css" rel="stylesheet" href="//unpkg.com/bootstrap/dist/css/bootstrap.min.css"/>
      <link type="text/css" rel="stylesheet" href="css/my-css.css"/>
      <title>Hello, world!</title>
      <style>
         .form-control.auto {
         display: inline-flex;
         -webkit-box-sizing: content-box;
         -moz-box-sizing: content-box;
         box-sizing: content-box;
         width: auto;
         min-width: 5rem;
         height: inherit!important;
         margin-top:.375rem;
         text-overflow: ellipsis;
         overflow: hidden;
         white-space: nowrap;
         }
         @keyframes strike {
         from { text-decoration-color: transparent; }
         to { text-decoration-color: auto; }
         }
         .strike {  
         text-decoration: line-through;
         animation: strike 2s linear;
         }
		  .result{
			  display:flex;
			  padding:0.5rem;
			  background: #FFEBBA;
			  border-radius:.85rem;
		  }
      </style>
   </head>
   <body>
      <main id="app" class="main">
         <section class="content">
            <div class="container-fluid">
               <!--new row-->
               <div class="row">
                  <div class="col-lg-8 col-sm-12 mb-4">
                     <div class="card">
                        <div class="card-body">
                           <div class="form-group">
                             <h5>Read the passage first then fill in the blanks</h5>
                              <p>Mi congue cubilia. Viverra adipiscing quisque aenean nulla at ipsum consectetuer ultricies, auctor ornare volutpat metus diam curabitur sed purus mattis cum class, felis <input type="text" class="form-control auto"><!--<span class="badge badge-danger">word two &#10060;</span> <span class="badge badge-success">word &#10004;</span>--> varius morbi ridiculus pellentesque inceptos sed.</p>
                              <p>Semper penatibus <!--<span class="badge badge-pill badge-success">yet another word &#10004;</span>-->  sapien viverra leo fermentum justo <input type="text" class="form-control auto">  <!--<span class="badge badge-pill badge-success">word three &#10004;</span>--> velit. A elementum a dictumst viverra tellus aliquam est. Venenatis. Placerat potenti lacinia massa rhoncus, iaculis nulla Nonummy senectus semper placerat primis ut montes quisque nunc nostra vestibulum pharetra cubilia. Gravida donec magna a <input type="text" class="form-control auto">  <!--<span class="badge badge-pill badge-danger">word two &#10060;</span> <span class="badge badge-pill badge-success">another word &#10004;</span-->> natoque morbi dictumst eu volutpat curae;</p>
                              <p>Dignissim eget eget <input type="text" class="form-control auto">  <!--<span class="badge badge-pill badge-success">word two &#10004;</span>--> luctus lacinia class torquent elementum commodo posuere consequat aliquam lobortis. Convallis nostra imperdiet natoque. Ornare.</p>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-4 col-sm-12 mb-4">
                     <div class="card">
                        <div class="card-body">
                           <h6>Missing words list</h6>
 <!--                          <span class="result mb-3"><i class="icon icon-smiley"></i> Your score 3/5</span>-->
                           <span class="badge badge-pill badge-secondary"><span class="strike">word</span></span>
                           <span class="badge badge-pill badge-info">word two</span>
                           <span class="badge badge-pill badge-info">word three</span>
                           <span class="badge badge-pill badge-secondary"><span class="strike">another word</span></span>
                           <span class="badge badge-pill badge-info">yet another word</span>
                           
<!--                           <span class="badge badge-pill badge-danger">word &#10060;</span>
                           <span class="badge badge-pill badge-success">word two &#10004;</span>
                           <span class="badge badge-pill badge-success">word three &#10004;</span>
                           <span class="badge badge-pill badge-danger">another word &#10060;</span>
                           <span class="badge badge-pill badge-success">yet another word &#10004;</span>-->
                           
                           <button class="btn btn-lg btn-success btn-block mt-4">Submit</button>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
      </main>
   </body>
</html>

