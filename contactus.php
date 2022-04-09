<?php include 'include/header.php' ?>
<title>Contact - Aptieco</title>
<!-- seo tags here -->
</head>
<body>
    <?php include 'include/nav.php' ?>
    <section class="contact" id="contact">

        <h1 class="heading"><span>#contact</span> us</h1>

        <div class="row">
            <iframe class="map"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d27251.176450264913!2d75.37436474046274!3d31.375613610716947!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x391a4854dcaaea2b%3A0x613bdd0931c8e3c9!2sKapurthala%2C%20Punjab!5e0!3m2!1sen!2sin!4v1644754689577!5m2!1sen!2sin"
                allowfullscreen="" loading="lazy"></iframe>

            <form id="form">
                <h3>get in touch</h3>
                <input type="text" placeholder="your name" name="from_name" id="from_name" class="box" required>
                <input type="email" placeholder="your email" name="reply_to" id="reply_to" class="box" required>
                <input type="tel" placeholder="phone number" name="phone_no" id="phone_no" class="box" required>
                <textarea placeholder="your message" name="message" id="message" class="box" cols="30" rows="10" required></textarea>
                <input type="submit" id="button" value="Send Message" class="btn">
            </form>

        </div>

    </section>
<?php include 'include/footer.php' ?>

<script type="text/javascript"
  src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>

<script type="text/javascript">
    emailjs.init('E5vruoVQX6dVgL4VT')

    const btn = document.getElementById('button');

    document.getElementById('form')
    .addEventListener('submit', function(event) {
    event.preventDefault();

    btn.value = 'Sending...';

    const serviceID = 'service_alles';
    const templateID = 'aptieco';

    emailjs.sendForm(serviceID, templateID, this)
        .then(() => {
        btn.value = 'Message Sent!';
        }, (err) => {
        btn.value = 'Send Message';
        alert(JSON.stringify(err));
        });
    });
</script>

</body>
</html>