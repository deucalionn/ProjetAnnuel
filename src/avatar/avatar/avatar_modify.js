const headTypeCount=6;
const HairTypeCount=7;
const EyesTypeCount=3;
const AccessoriesTypeCount=4;

var ChaHead,ChaHeadNum,ChaHeadName;
var ChaHair,ChaHairNum,ChaHeadName;
var ChaEye,ChaEyeNum,ChaEyeName;
var ChaAccessorie,ChaAccessorieNum,ChaAccessorieName;

ChaHeadNum=document.getElementById("headDisp").value;
ChaHairNum=document.getElementById("hairDisp").value;
ChaEyeNum=document.getElementById("eyesDisp").value;
ChaAccessorieNum=document.getElementById("accessoriesDisp").value;


window.onload = function(){   

    //Forme Tete
    ChaHead = new Image();
    //ChaHeadNum=Math.floor(Math.random()*headTypeCount)+1;
    ChaHeadName="avatar/head"+ChaHeadNum+".png";
    
    ChaHead.src=ChaHeadName;
    //Forme Cheveux
    ChaHair = new Image();
    //ChaHairNum=Math.floor(Math.random()*HairTypeCount)+1;
    ChaHairName="avatar/hair"+ChaHairNum+".png";
    ChaHair.src=ChaHairName;
    //Forme yeux
    ChaEye = new Image();
    //ChaEyeNum=Math.floor(Math.random()*EyesTypeCount)+1;
    ChaEyeName="avatar/eyes"+ChaEyeNum+".png";
    ChaEye.src=ChaEyeName;
    //Forme accessoire MAX 1
    ChaAccessorie = new Image();
    //ChaAccessorieNum=Math.floor(Math.random()*AccessoriesTypeCount)+1;
    ChaAccessorieName="avatar/Accessories"+ChaAccessorieNum+".png";
    ChaAccessorie.src=ChaAccessorieName;


    // on les charges un aprés l'autre l'un sur l'autre
    
    //Chargement tete
    ChaHead.onload=function(){
        buildCharAvatar();
    }
    //Chargement cheveux
    ChaHair.onload=function(){
        buildCharAvatar();
    }
    //Chargement yeux
    ChaEye.onload=function(){
        buildCharAvatar();
    }
    //Chargement accessoire
    ChaAccessorie.onload=function(){
        buildCharAvatar();
    }


}
function buildCharAvatar(){

    
    var canvas=document.getElementById('canvas');
    var ctx =canvas.getContext('2d');
    ctx.clearRect(0,0,180,170)
    canvas.width=180;
    canvas.height=170;
    //Random bg
    ctx.fillStyle =("#FFFFFF");
    ctx.fillRect(0,0,180,170);
    //Afficher tete
    ctx.drawImage(ChaHead,((180-ChaHead.width)/2),10);
    //Afficher cheveux
    ctx.drawImage(ChaHair,((180-ChaHair.width)/2),10);
    //Afficher yeux
    ctx.drawImage(ChaEye,((180-ChaEye.width)/2),10);
    //Afficher nez
    ctx.drawImage(ChaAccessorie,((180-ChaAccessorie.width)/2),10);
    //console.log(ChaHead,ChaHair,ChaEye,ChaAccessorie);
    //console.log(ctx);
/*
    var dataURL = canvas.toDataURL();
    console.log(dataURL);*/
    document.getElementById("headDisp").value=ChaHeadNum;
    document.getElementById("hairDisp").value=ChaHairNum;
    document.getElementById("eyesDisp").value=ChaEyeNum;
    document.getElementById("accessoriesDisp").value=ChaAccessorieNum;

    //console.log(ChaHeadNum,ChaHead);
}

function head0(){
    console.log(ChaHeadNum,ChaHead);
    ChaHeadNum-=1; 
    if(ChaHeadNum<1){
        ChaHeadNum=headTypeCount;
    }
    console.log(ChaHeadNum,ChaHead);
    ChaHeadName="avatar/head"+ChaHeadNum+".png";
    ChaHead.src=ChaHeadName;
    //document.getElementsByName('head').id=ChaHeadNum;

    buildCharAvatar();
    console.log(ChaHeadNum,ChaHead);
    
}
function hair0(){
    ChaHairNum-=1; 
    if(ChaHairNum<1){
        ChaHairNum=HairTypeCount;
    }
    ChaHairName="avatar/hair"+ChaHairNum+".png";
    ChaHair.src=ChaHairName;
    buildCharAvatar();
    
}
function eyes0(){
    ChaEyeNum-=1;
    if(ChaEyeNum<1){
        ChaEyeNum=EyesTypeCount;
    }
    ChaEyeName="avatar/eyes"+ChaEyeNum+".png";
    ChaEye.src=ChaEyeName;
    buildCharAvatar();
}
function accessories0(){
    ChaAccessorieNum-=1; 
    if(ChaAccessorieNum<1){
        ChaAccessorieNum=AccessoriesTypeCount;
    }
    ChaAccessorieName="avatar/Accessories"+ChaAccessorieNum+".png";
    ChaAccessorie.src=ChaAccessorieName;
    buildCharAvatar();
}

function head1(){
    ChaHeadNum+=1;  
    if(ChaHeadNum>headTypeCount){
        ChaHeadNum=1;
    }
    ChaHeadName="avatar/head"+ChaHeadNum+".png";
    ChaHead.src=ChaHeadName;
    buildCharAvatar();
}
function hair1(){
    ChaHairNum+=1; 
    if(ChaHairNum>HairTypeCount){
        ChaHairNum=1;
    }
    ChaHairName="avatar/hair"+ChaHairNum+".png";
    ChaHair.src=ChaHairName;
    buildCharAvatar();
}
function eyes1(){
    ChaEyeNum+=1; 
    if(ChaEyeNum>EyesTypeCount){
        ChaEyeNum=1;
    }
    ChaEyeName="avatar/eyes"+ChaEyeNum+".png";
    ChaEye.src=ChaEyeName;
    buildCharAvatar();
}
function accessories1(){
    ChaAccessorieNum+=1;  
    if(ChaAccessorieNum>AccessoriesTypeCount){
        ChaAccessorieNum=1;
    }
    ChaAccessorieName="avatar/Accessories"+ChaAccessorieNum+".png";
    ChaAccessorie.src=ChaAccessorieName;
    buildCharAvatar();
}





