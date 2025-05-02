const mobileMenu = document.getElementById('mobile-menu');
    const navLinks = document.getElementById('nav-links');

    mobileMenu.addEventListener('click', () => {
      navLinks.classList.toggle('show');
    });

    function toggleContent(section) {
      const content = document.getElementById(section + '-content');
      const button  = document.querySelector('#' + section + '-section .toggle-button');
      
      if (!content.classList.contains('open')) {
        // ===> OPEN
        content.classList.add('open');
        button.innerText = 'Hide';
      } else {
        // ===> CLOSE
        content.classList.remove('open');
        button.innerText = section.charAt(0).toUpperCase() + section.slice(1);
      }
    }