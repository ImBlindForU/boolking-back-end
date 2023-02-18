const form = document.querySelector('#payment-form');
const button = document.querySelector('#submit-button');
const token = button.getAttribute('token');

const container1 = document.querySelector('.container1');

const rightSide = document.querySelector('.right-side');
const animation = document.getAnimations('slide-post');
const animation1 = document.getAnimations('slide-top');


braintree.dropin.create({
    authorization: token,
    container: '#dropin-container'
  }, (error, dropinInstance) => {

    rightSide.classList.add('active');
          
    container1.classList.remove('active');
    rightSide.classList.remove('active');

    if (error) console.error(error);
 
    form.addEventListener('submit', event => {
      event.preventDefault();

      container1.classList.add('active')

     
 
      dropinInstance.requestPaymentMethod((error, payload) => {
        if (error) console.error(error);
 
        // Step four: when the user is ready to complete their
        //   transaction, use the dropinInstance to get a payment
        //   method nonce for the user's selected payment method, then add
        //   it a the hidden field before submitting the complete form to
        //   a server-side integration
        document.getElementById('nonce').value = payload.nonce;
        form.submit();

  
      });
    });
  });

  