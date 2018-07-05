<div class="cart-items">
	<div class="container">
			 <h3 align="left">Seleccione Un tipo de pago</h3>
			<div align="center">
				<div class="col-lg-12 col-md-12 col-sm-12">
					
			<form action="<?=$this->config->base_url()?>stripe_payment/checkout" method="POST">
			<button type="button" class="btn btn-default"><img src="<?= $this->config->base_url();?>assets/img/paypal.png" width="150" height="50"></button>
				
  <script
    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
    data-key="pk_test_eoz1V6stqwxiCPwkvu9Ywgoz"
    data-amount="999"
    data-name="algo aqui"
    data-description="Algo de wiget"
    data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
    data-locale="es">
  </script>
</form>
			</div>
	</div>
			</div>
		 </div>
