
var ChaHead,ChaHeadNum,ChaHeadName;
var ChaHair,ChaHairNum,ChaHeadName;
var ChaEye,ChaEyeNum,ChaEyeName;
var ChaAccessorie,ChaAccessorieNum,ChaAccessorieName;    
var arr=document.getElementById("canvas").attributes.value;

    let str=arr.value.toString().split(',');

    ChaHeadNum=str[0];
    ChaHairNum=str[1];
    ChaEyeNum=str[2];
    ChaAccessorieNum=str[3];

    //Forme Tete
    ChaHead = new Image();

    ChaHeadName="/ProjetAnnuel/src/avatar/avatar/avatar/head"+ChaHeadNum+".png";
    
    ChaHead.src=ChaHeadName;
    //Forme Cheveux
    ChaHair = new Image();

    ChaHairName="/ProjetAnnuel/src/avatar/avatar/avatar/hair"+ChaHairNum+".png";
    ChaHair.src=ChaHairName;
    //Forme yeux
    ChaEye = new Image();

    ChaEyeName="/ProjetAnnuel/src/avatar/avatar/avatar/eyes"+ChaEyeNum+".png";
    ChaEye.src=ChaEyeName;
    //Forme accessoire MAX 1
    ChaAccessorie = new Image();

    ChaAccessorieName="/ProjetAnnuel/src/avatar/avatar/avatar/Accessories"+ChaAccessorieNum+".png";
    ChaAccessorie.src=ChaAccessorieName;
    
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
    
function buildCharAvatar(){

    
    var canvas=document.getElementById('canvas');
    var ctx =canvas.getContext('2d');
    ctx.clearRect(0,0,180,180)
    canvas.width=180;
    canvas.height=180;
    //Random bg
    ctx.fillStyle =("#FFFFFF");
    ctx.fillRect(0,0,180,180);
    //Afficher tete
    ctx.drawImage(ChaHead,((180-ChaHead.width)/2),10);
    //Afficher cheveux
    ctx.drawImage(ChaHair,((180-ChaHair.width)/2),10);
    //Afficher yeux
    ctx.drawImage(ChaEye,((180-ChaEye.width)/2),10);
    //Afficher nez
    ctx.drawImage(ChaAccessorie,((180-ChaAccessorie.width)/2),10);
}
