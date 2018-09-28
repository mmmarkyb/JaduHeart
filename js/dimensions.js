var imageID = [blueAlien, dimDream, eye, eyeAlien, flower, screenShot, redAlien]

var imlocation = "img/dimensions/";
var currentdate = 0;
var image_number = 0;
function ImageArray (n) {
  this.length = n;
  for (var i =1; i <= n; i++) {
    this[i] = ' '
  }
}
image = new ImageArray(7)
image[0] = 'blueAlien.png';
image[1] = 'dimDream.png';
image[2] = 'eye.png';
image[3] = 'eyeAlien.png';
image[4] = 'flower.png';
image[5] = 'redAlien.png';
image[6] = 'flowerText.png'

function randomimage() {
    
    image_number = Math.floor(Math.random() * 6) + 1  
    return(image[image_number])
}
document.write("<img src='" + imlocation + randomimage()+ "'>");