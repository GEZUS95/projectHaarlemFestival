<footer>
    <div class="about-us">
        <h1 class="footer-header">ABOUT US</h1>
        <p class="footer-p">Haarlem Festival has been a trusted home for live music since 2021.
            From day one, we’ve set about making it as easy, fun and fair as possible for you to see your favorite
            artists live.</p>
    </div>
    <div class="our-contacts">
        <h1 class="footer-header">OUR CONTACTS</h1>
        <p class="footer-p">Email: HaarlemFestival@gmail.com <br>
            Phone: (012) 345 6789 <br>
            Adress: Zijlvest 39, 2011 VB Haarlem <br>
        </p>
    </div>
    <div class="links">
        <h1 class="footer-header">LINKS</h1>
        <ul class="footer">
            <li><a href="{{\Matrix\Managers\RouteManager::getUrlByRouteName("home")}}">Home Page</a></li>
            <li><a href="{{\Matrix\Managers\RouteManager::getUrlByRouteName("login")}}">Login</a></li>
            <li><a href="{{\Matrix\Managers\RouteManager::getUrlByRouteName("register")}}">Register</a></li>
        </ul>
    </div>
    <div class="contact-us">
        <h1 class="footer-header">CONTACT US</h1>
        <form class="footer-contact-form" action="{{\Matrix\Managers\RouteManager::getUrlByRouteName("contact")}}"
              method="post">
            <input type="text" name="footer-name" id="footer-name" required placeholder="Name">
            <input type="email" name="footer-email" id="footer-email" required placeholder="Email">
            <input type="text" name="footer-message" id="footer-message" required placeholder="Message">
        </form>
    </div>
</footer>