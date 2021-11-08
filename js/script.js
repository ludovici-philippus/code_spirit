window.onload = () => {
    const mobile_menu = document.getElementById("mobile_menu");
    const ul_mobile = document.getElementById("ul_mobile");
    const slider = document.querySelector(".slider-wraper");
    const slider_single = document.querySelectorAll(".slider-single");
    let clicked = false;
    let slide = 0;
    let scrolling = false;
    const max_slide = slider_single.length;

    
    const navigation = document.querySelectorAll("a.one-page");

    let scroll_based_on = (element) => {
        const go_to = element.getAttribute("goto");
        document.getElementById(go_to).scrollIntoView({behavior:"smooth"});
        setTimeout((e) => {
            scrolling = false;
        }, 500);
    };

    navigation.forEach(element => {
        element.addEventListener("click", (e) => {
            scrolling = true;
            e.preventDefault();
            scroll_based_on(element);
            return false;
        })
    })

    const ul_mobile_animation = (duration, type) =>{
        if(type == 1){
            ul_mobile.animate([
                {transform:"translateX(-500px)"},
                {transform:"translateX(0px)"}
            ], 
            {
                duration: duration,
            });    
            ul_mobile.style.transform = "translateX(0px)";
        }else{
            ul_mobile.animate([
                {transform:"translateX(0px)"},
                {transform:"translateX(-500px)"}
            ], 
            {
                duration: duration,
            });
            ul_mobile.style.transform = "translateX(-500px)";
            
        }
    }

    mobile_menu.addEventListener("click", ()=>{
        if(!clicked){
            ul_mobile_animation(500, 1);
        }else{
            ul_mobile_animation(500, 2);
        }
        clicked = !clicked;
    });
    
    setInterval((e) => {
        if(!scrolling){
            if(slide < max_slide){
                slider.scrollTo({left:slider_single[slide].offsetLeft, behavior: "smooth"});
            }else{
                slide = -1;
            }
            slide++;
        }
    }, 3000);
}