function change_theme()
{

    switch(document.getElementById("theme_value").value)
    {

        case "0":

            document.body.style = 'background-image: url("./View/Assets/Images/Wallpapers/Naruto.jpeg");';

            document.getElementById("theme_choice").value = "Naruto Shippuden";

        break;

        case "1":

            document.body.style = 'background-image: url("./View/Assets/Images/Wallpapers/JoJo.jpg");';

            document.getElementById("theme_choice").value = "JoJo's Bizarre Adventure";

        break;

        case "2":

            document.body.style = 'background-image: url("./View/Assets/Images/Wallpapers/Dragon_Ball.jpg");';

            document.getElementById("theme_choice").value = "Dragon Ball Z";

        break;

        case "3":

            document.body.style = 'background-image: url("./View/Assets/Images/Wallpapers/Hunter_Hunter.jpg");';

            document.getElementById("theme_choice").value = "Hunter X Hunter";

        break;
        
    }

}