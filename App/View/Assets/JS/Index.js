function change_theme()
{

    switch(document.getElementById("theme_value").value)
    {

        case "0":

            document.body.style = 'background-image: url("./View/Assets/Images/Wallpapers/Attack_on_Titan.png");';

            document.getElementById("theme_choice").value = "Attack on Titan";

        break;

        case "1":

            document.body.style = 'background-image: url("./View/Assets/Images/Wallpapers/Berserk.jpg");';

            document.getElementById("theme_choice").value = "Berserk";

        break;

        case "2":

            document.body.style = 'background-image: url("./View/Assets/Images/Wallpapers/Bleach.jpg");';

            document.getElementById("theme_choice").value = "Bleach";

        break;

        case "3":

            document.body.style = 'background-image: url("./View/Assets/Images/Wallpapers/Boku_no_Hero.png");';

            document.getElementById("theme_choice").value = "Boku no Hero";

        break;

        case "4":

            document.body.style = 'background-image: url("./View/Assets/Images/Wallpapers/Dragon_Ball.jpg");';

            document.getElementById("theme_choice").value = "Dragon Ball Z";

        break;

        case "5":

            document.body.style = 'background-image: url("./View/Assets/Images/Wallpapers/Fairy_Tail.png");';

            document.getElementById("theme_choice").value = "Fairy Tail";

        break;

        case "6":

            document.body.style = 'background-image: url("./View/Assets/Images/Wallpapers/Hunter_Hunter.jpg");';

            document.getElementById("theme_choice").value = "Hunter X Hunter";

        break;

        case "7":

            document.body.style = 'background-image: url("./View/Assets/Images/Wallpapers/JoJo.jpg");';

            document.getElementById("theme_choice").value = "JoJo's Bizarre Adventure";

        break;

        case "8":

            document.body.style = 'background-image: url("./View/Assets/Images/Wallpapers/Jujutsu_Kaisen.jpg");';

            document.getElementById("theme_choice").value = "Jujutsu Kaisen";

        break;

        case "9":

            document.body.style = 'background-image: url("./View/Assets/Images/Wallpapers/Nanatsu_no_Taizai.jpg");';

            document.getElementById("theme_choice").value = "Nanatsu no Taizai";

        break;

        case "10":

            document.body.style = 'background-image: url("./View/Assets/Images/Wallpapers/Naruto_Shippuden.jpeg");';

            document.getElementById("theme_choice").value = "Naruto Shippuden";

        break;

        case "11":

            document.body.style = 'background-image: url("./View/Assets/Images/Wallpapers/One_Piece.jpg");';

            document.getElementById("theme_choice").value = "One Piece";

        break;
        
    }

}