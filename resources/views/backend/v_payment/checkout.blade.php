<script type="text/javascript" src="https://app.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
<script type="text/javascript">
    // Handle the payment request after page loads
    document.addEventListener('DOMContentLoaded', function() {
        var snapToken = "{{ $snapToken }}"; // token Snap Midtrans yang dikirim dari controller
        
        // Trigger the Midtrans popup
        snap.pay(snapToken, {
            onSuccess: function(result) {
                alert("Payment success!"); // Success handler
            },
            onPending: function(result) {
                alert("Waiting for payment confirmation!"); // Pending handler
            },
            onError: function(result) {
                alert("Payment failed!"); // Error handler
            }
        });
    });
</script>
