const bannerBtn = document.getElementById("addBannerButton");
const profileBtn = document.getElementById("addProfileButton");
const bannerInput = document.getElementById("bannerInput");
const profileInput = document.getElementById("profileInput");
const banner =document.getElementById("bannerImage");
const profile =document.getElementById("profileImage");

//input activation
bannerBtn.addEventListener('click', function(){
    bannerInput.click();
})

//input activation
profileBtn.addEventListener('click', function(){
    profileInput.click();
})

//plotting profile image
profileInput.addEventListener('change',function(event){
    const file = event.target.files[0];

    if(file){
        const reader = new FileReader();

        reader.onload = function(e){
            profile.src = e.target.result;
        }

        reader.readAsDataURL(file);
    }
});

//plotting banner image
bannerInput.addEventListener('change',function(event){
    const file = event.target.files[0];

    if(file){
        const reader = new FileReader();

        reader.onload = function(e){
            banner.src = e.target.result;
        }

        reader.readAsDataURL(file);
    }
});