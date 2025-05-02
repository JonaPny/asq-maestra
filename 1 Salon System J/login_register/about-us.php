<?php include('header1.php'); ?>

<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Poppins:wght@300;400;500;600&display=swap"/>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="/CSS/about-us.css">
<script src="/JAVASCRIPT/about-us.js"></script>

<section class="about-section">
  <div class="history-text">
    <h1>History</h1>
  </div>

  <div class="about-wrapper">
    <div class="salon-column">
      <div class="salon">
        <img src="/PHOTOS/salon image.jpg" alt="image" class="salon-image" />
      </div>
      <p class="since-text">Since 2021</p>
    </div>

    <div class="about-text">
      <div class="about-description">
        <p>
          Jose Maestra Barbera Salon is owned by Myrsel Jose, who inherited the talent 
          from her late grandfather, a skilled barber.
        </p>
        <p>
          She had the idea to start her own salon, beginning with home visits and eventually 
          establishing her own shop. Her goal is to be recognized as a skilled female barber.
        </p>
        <p>
          Jose Maestra Barbera Salon offers haircut services for women, men and children.
          They also provide not just hair treatemnts but makeup, nail services and briads with extensions as well!
        </p>
      </div>
    </div>
  </div>
</section>

<section class="about-location">
  <h1>Our Location</h1>
  <div class="location-wrapper">
    <div class="location-text">
      <p>We are located at Asia 1 Priscilla Commercial Building Unit 6, kapayapaan Village, Canlubang,
        Calamba City, Laguna.</p>

      <strong> Landmark Area:</strong><i> Near Canlubang Institute School or at the back 
        of Alfamart Canlubang.</i>
    </div>

    <div class="map-container">
      <iframe
        class="google-map"
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3867.7986199402776!2d121.09222027040187!3d14.206566656204235!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33bd6342ae1539a9%3A0x340a553b10e5be11!2sJoseMaestraBarberaSalon!5e0!3m2!1sen!2sph!4v1745071668755!5m2!1sen!2sph"
        allowfullscreen=""
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade">
      </iframe>
    </div>
  </div>
</section>

<div class="about-container container">
  <div class="section" id="vision-section">
    <button class="toggle-button" onclick="toggleContent('vision')">Vision</button>
    <div class="content" id="vision-content">
      <p>Our Vision at JoseMaestra Barbera Salon is to become the leading destination 
        for transformative beauty experiences, recognized for our innovation, excellence and 
        personalized service.</p>
        
      <p> We aspire to set the standard in the industry by continuously evolving our techniques and offerings to 
        meet the diverse needs of our clients, while fostering a community where creativity, 
        professionalism, and client satisfaction are at the heart of everything we do.</p>
    </div>
  </div>

  <div class="vertical-divider" id="divider-line"></div>

  <div class="section" id="mission-section">
    <button class="toggle-button" onclick="toggleContent('mission')">Mission</button>
    <div class="content" id="mission-content">
      <p>At Josemaestra Barbera Salon, our mission is to enhance every client's confidence and style by providing exceptional haircuts, treatments, and coloring services.
         We are dedicated to delivering a personalized and high-quality experience for individuals of all ages, 
         while also offering expert makeup and nail services to complete every look.</p>

         <p>Our commitment is to create a welcoming and professional environment
          where each client feels valued and leaves feeling their best</p>
    </div>
  </div>
</div>

<section class="owner-section">
  <h2 class="owner-title">Owner</h2>
  <div class="owner-container">
    <div class="owner-left">
      <div class="owner-image">
        <img src="/PHOTOS/Myrsel.jpg" alt="Salon Owner">
        <a href="https://www.facebook.com/share/18zCXgBYbm/" target="_blank" class="social-overlay">
          <i class="fab fa-facebook-f"></i>
        </a>
      </div>
      <h3 class="owner-name">Myrsel Jose</h3>
    </div>

    <div class="owner-right">
      <p>
        Myrsel Jose founded JoseMaestra Barbera Salon in 2021, carrying on a family legacy of masterful barbering.
        With over a decade of hands‑on experience, she blends traditional techniques with modern flair, 
        ensuring every client leaves feeling confident and refreshed.
      </p>
      <p>
        Beyond haircuts, she’s passionate about mentoring the next generation of stylists and 
        creating a warm, inclusive environment where everyone feels at home.
      </p>
    </div>
  </div>
</section>

<?php include('footer1.php'); ?>
