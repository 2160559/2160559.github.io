<!DOCTYPE html>
<html>
  <?php session_start();
  require_once('includes/head.inc.php') ?>
  <body>
    <?php
    include_once('includes/nav.inc.php');
  include_once('functions.php');
  include_once('User.php');
  include_once('getUser.php');
  include_once('includes/db.inc.php');
    ?>
    <div class="container">
      <div class="row m-4 pb-5 justify-content-center">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header"><h1>Book</h1></div>
            <div class="card-body">

              <div class="row">
                <div class="col-md-4 order-md-2 mb-4">
                  <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Total</span>
                    <span class="badge badge-secondary badge-pill">3</span>
                  </h4>
                  <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                      <div>
                        <h6 class="my-0">Transient Name</h6>
                        <small class="text-muted">No of guests</small>
                      </div>
                      <span class="text-muted">$12</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                      <div>
                        <h6 class="my-0">Second product</h6>
                        <small class="text-muted">Brief description</small>
                      </div>
                      <span class="text-muted">$8</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                      <div>
                        <h6 class="my-0">Third item</h6>
                        <small class="text-muted">Brief description</small>
                      </div>
                      <span class="text-muted">$5</span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between">
                      <span>Total (PHP)</span>
                      <strong>20000</strong>
                    </li>
                  </ul>


                </div>
                <div class="col-md-8 order-md-1">
                  <form class="needs-validation" novalidate>

                    <hr class="mb-4">

                    <h4 class="mb-3">Payment</h4>

                    <div class="d-block my-3">
                      <div class="custom-control custom-radio">
                        <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked required>
                        <label class="custom-control-label" for="credit">Credit card</label>
                      </div>
                      <div class="custom-control custom-radio">
                        <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required>
                        <label class="custom-control-label" for="debit">Debit card</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 mb-3">
                        <label for="cc-name">Name on card</label>
                        <input type="text" class="form-control" id="cc-name" placeholder="" required>
                        <small class="text-muted">Full name as displayed on card</small>
                        <div class="invalid-feedback">
                          Name on card is required
                        </div>
                      </div>
                      <div class="col-md-6 mb-3">
                        <label for="cc-number">Credit card number</label>
                        <input type="text" class="form-control" id="cc-number" placeholder="" required>
                        <div class="invalid-feedback">
                          Credit card number is required
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3 mb-3">
                        <label for="cc-expiration">Expiration</label>
                        <input type="text" class="form-control" id="cc-expiration" placeholder="" required>
                        <div class="invalid-feedback">
                          Expiration date required
                        </div>
                      </div>
                      <div class="col-md-3 mb-3">
                        <label for="cc-cvv">CVV</label>
                        <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
                        <div class="invalid-feedback">
                          Security code required
                        </div>
                      </div>
                    </div>
                    <hr class="mb-4">
                    <button class="btn btn-info btn-lg float-right" type="submit" data-toggle="modal" data-target="#confirmation">Confirm</button>          
                  </form>
                  <a class="btn btn-info btn-lg" href="reservation.php">Back</a>
                </div>
              </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="confirmation" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">            
                    <div>
                      <img src="images/confirm.png" class="img-fluid" style="display: block; margin-left: auto;
                                                                             margin-right: auto;"/>
                    </div> 
                  </div>
                  <div class="modal-footer">
                    <a class="btn btn-info btn-sm" href="index.php">GO BACK TO HOMEPAGE</a>
                  </div>
                </div>
              </div>
            </div>             

            <script>
              // Example starter JavaScript for disabling form submissions if there are invalid fields
              (function() {
                'use strict';

                window.addEventListener('load', function() {
                  // Fetch all the forms we want to apply custom Bootstrap validation styles to
                  var forms = document.getElementsByClassName('needs-validation');

                  // Loop over them and prevent submission
                  var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                      if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                      }
                      form.classList.add('was-validated');
                    }, false);
                  });
                }, false);
              })();
            </script>
          </div>
        </div>
      </div>
    </div>
    <?php require_once ('includes/footer.inc.php')?>
  </body>
</html>