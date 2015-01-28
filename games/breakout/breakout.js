//fix address bar scroll, sizing to height, width is off(ratio,non-scrolling?)
//fix ball hits side of brick
//new bricks function
//new ball function
//start/pause/end game screen
var WIDTH = 480;
var HEIGHT = 640;
var canvas = null;
var ctx = null;
var RATIO = null;
var CURR_WIDTH = null;
var CURR_HEIGHT = null;
var a = 0;	//accumulates fractions of  a second
var lastDown = 0;
var mouseX;
var offsetTop;
var offsetLeft;
var scale;
var b = 0;	//collision timer
var balls = 3;

//cross-browser support
var w = window;
requestAnimationFrame = w.requestAnimationFrame || 
                        w.webkitRequestAnimationFrame || 
                        w.msRequestAnimationFrame || 
                        w.mozRequestAnimationFrame;

window.addEventListener('load', init(), false);
window.addEventListener('resize', resize(), false);

//hide mobile address bar
var ua = navigator.userAgent.toLowerCase();
var android = ua.indexOf('android') > -1 ? true : false;
var ios = ( ua.indexOf('iphone') > -1 || ua.indexOf('ipad') > -1  ) ? true : false;






//load image
var bgReady = false;
var bgImage = new Image();
bgImage.onload = function () {
    bgReady = true;
};
bgImage.src = "media/background.png";

//load image
var paddleReady = false;
var paddleImage = new Image();
paddleImage.onload = function () {
    paddleReady = true;
};
paddleImage.src = "media/paddle.png";

//load image
var ballReady = false;
var ballImage = new Image();
ballImage.onload = function () {
    ballReady = true;
};
ballImage.src = "media/ball.png";

//load image
var brickRedReady = false;
var brickRedImage = new Image();
brickRedImage.onload = function () {
    brickRedReady = true;
};
brickRedImage.src = "media/brickRed.png";

//load image
var brickOrangeReady = false;
var brickOrangeImage = new Image();
brickOrangeImage.onload = function () {
    brickOrangeReady = true;
};
brickOrangeImage.src = "media/brickOrange.png";

//load image
var brickYellowReady = false;
var brickYellowImage = new Image();
brickYellowImage.onload = function () {
    brickYellowReady = true;
};
brickYellowImage.src = "media/brickYellow.png";

//load image
var brickGreenReady = false;
var brickGreenImage = new Image();
brickGreenImage.onload = function () {
    brickGreenReady = true;
};
brickGreenImage.src = "media/brickGreen.png";

//load image
var brickBlueReady = false;
var brickBlueImage = new Image();
brickBlueImage.onload = function () {
    brickBlueReady = true;
};
brickBlueImage.src = "media/brickBlue.png";


//load sound
var paddleSound = new Audio("media/collPaddle.wav");
paddleSound.load();

var wallSound = new Audio("media/collWall.wav");
wallSound.load();

var brickSound = new Audio("media/collBrick.wav");
brickSound.load();

var brickKillSound = new Audio("media/collBrickKill.wav");
brickKillSound.load();

//keep list of keys currently held down
var keysDown = {};

document.addEventListener("keydown", function (e) {
    keysDown[e.keyCode] = true;
    prevDown = lastDown;
    lastDown = e.keyCode;
}, false);

document.addEventListener("keyup", function (e) {
    delete keysDown[e.keyCode];
}, false);

document.addEventListener("mousemove", function (e) {
    if(!e)
	{
		var e = event;
	}
	mouseX = e.pageX-offsetLeft;
	mouseY = e.pageY;
	
}, false);

// listen for clicks
window.addEventListener('click', function(e) {
    e.preventDefault();

}, false);

// listen for touches
window.addEventListener('touchstart', function(e) {
    e.preventDefault();
    // the event object has an array
    // named touches; we just want
    // the first touch
}, false);
window.addEventListener('touchmove', function(e) {
    // we're not interested in this,
    // but prevent default behaviour
    // so the screen doesn't scroll
    // or zoom
	mouseX = (e.changedTouches[0].clientX-offsetLeft-paddle.width);
    e.preventDefault();
}, false);
window.addEventListener('touchend', function(e) {
    // as above
    e.preventDefault();
}, false);









//objects
var paddle = {
	height: 16,
	width: 96,
	y: HEIGHT - 64,
	x: mouseX
}

var ball = {
	x: (WIDTH/2)-8,
	y: (HEIGHT/2)-8,
	speedx: 0,
	speedy: 5,
	width: 16,
	height: 16
}

var score = 0;

var bricks = [];

function brick(ex, why, pic, health){
	this.image = pic;
	this.life = health;
	this.x =  ex;
	this.y = why*16;
	this.width = 48;
	this.height = 16;
}


for(var i = 0; i<50; i++)
{
	if(i<10)
	{
		bricks[i] = new brick(i*48,4,brickRedImage,5);
	}
	else if(i<20)
	{
		bricks[i] = new brick((i-10)*48,5,brickOrangeImage,4);
	}
	else if(i<30)
	{
		bricks[i] = new brick((i-20)*48,6,brickYellowImage,3);
	}
	else if(i<40)
	{
		bricks[i] = new brick((i-30)*48,7,brickGreenImage,2);
	}
	else if(i<50)
	{
		bricks[i] = new brick((i-40)*48,8,brickBlueImage,1);
	}
}











function collides(rect1,rect2)
{
	if (rect1.x < rect2.x + rect2.width &&
	rect1.x + rect1.width > rect2.x &&
	rect1.y < rect2.y + rect2.height &&
	rect1.height + rect1.y > rect2.y) 
	{
		return true;
	}
	return false;
}

function collidesSide(rect1,rect2)
{
	if (rect1.x < rect2.x + rect2.width &&
	rect1.x + rect1.width > rect2.x &&
	rect1.y < rect2.y + rect2.height &&
	rect1.height + rect1.y > rect2.y) 
	{
		return true;
	}
	return false;
}

function init()
{
    RATIO = WIDTH/HEIGHT;
    CURR_WIDTH = WIDTH;
    CURR_HEIGHT = HEIGHT;
	
	
    canvas = document.createElement("canvas");
    ctx = canvas.getContext("2d");

    canvas.width = WIDTH;
    canvas.height = HEIGHT;
	
	
	
    //style the page
    document.body.appendChild(canvas);
    document.body.style.fontFamily = 'Share Tech Mono';
    document.body.style.backgroundColor = "#FFF";
    document.body.style.margin = "auto";
    
    //style the canvas
    canvas.style.display = "block";
    canvas.style.margin = "auto";
    
    //google font
    var newStyle = document.createElement('style');
    newStyle.appendChild(document.createTextNode(
            "@font-face\n\
            {font-family: 'Share Tech Mono'; \n\
            font-style: normal; font-weight: 400; \n\
            src: local('Share Tech Mono'), local('ShareTechMono-Regular'), url(http://fonts.gstatic.com/s/sharetechmono/v4/RQxK-3RA0Lnf3gnnnNrAsYdJ2JT0J65PSe7wdxAnx_I.woff2) format('woff2'); \n\
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215, U+E0FF, U+EFFD, U+F000;}"
            ));
    document.head.appendChild(newStyle);
	
	offsetTop = canvas.offsetTop;
	offsetLeft = canvas.offsetLeft;
}


function resize()
{
    //resize width in proportion to height
    CURR_HEIGHT = window.innerHeight;
    CURR_WIDTH = CURR_HEIGHT * RATIO;
	scale = CURR_WIDTH/WIDTH;
    if(CURR_WIDTH > window.innerWidth)
    {
        CURR_WIDTH = window.innerWidth;
        CURR_HEIGHT = CURR_WIDTH * (1+RATIO);
    }
    //some extra space to scroll past the address bar
    if (android || ios) 
    {
        document.body.style.height = (window.innerHeight + 50) + 'px';
    }

    //scale it with CSS
    canvas.style.width = CURR_WIDTH + 'px';
    canvas.style.height = CURR_HEIGHT + 'px';
    //some mobile browsers don't fire without a delay
    window.setTimeout(function() 
    {
        window.scrollTo(0,1);
    }, 1);
	
}














/**************\
**   UPDATE   **
\**************/
//game logic runs here
function update(modifier) {
    a += modifier*5;
	
    paddle.x = (mouseX-(paddle.width/2))/scale;

    ball.x += ball.speedx;
	ball.y += ball.speedy;
	
    if(a>1)
    {
        a = 0;
    }
	if(b)
	{
		b -= a;
		if(b<0)
		{
			b=0;
		}
	}
	//wall collision
	if(	
	ball.x<=0 ||
	ball.x>=WIDTH-ball.width)
	{
		wallSound.play();
		ball.speedx *= -1;
	}
	if(	
	ball.y<=0 ||
	ball.y>=HEIGHT+ball.height)
	{
		if(ball.y>=HEIGHT+ball.height)
		{
			//ball lost
			wallSound.play();
			ball.speedy *= -1;
			balls--;
		}
		else
		{
			wallSound.play();
			ball.speedy *= -1;
		}
	}
	
	//paddle collision
	if (collides(ball,paddle)) 
    {
		paddleSound.play();
		ball.speedx *= -1;
		ball.speedy *= -1;
		if(ball.x>paddle.x+(paddle.width*(2/3))-(ball.width/2))
		{
			ball.speedx = 5;
		}
		else if(ball.x<paddle.x+(paddle.width*(1/3))-(ball.width/2))
		{
			ball.speedx = -5;
		}
		else
		{
			ball.speedx = 0;
		}

	}
	
	//brick collision
	for(var i = 0; i<bricks.length; i++)
	{
		if(bricks[i])
		{
			if(collides(ball,bricks[i]) && !b)
			{
				b = .1;
				ball.speedy *= -1;
				bricks[i].life--;
				score++;
				if(bricks[i].life <=0)
				{
					brickKillSound.play();
					delete bricks[i];
				}
				else
				{
						brickSound.play();
				}
			}
		}
	}

};


/**************\
**   RENDER   **
\**************/
//game drawing runs here
function render() {
    if (bgReady) {
        ctx.drawImage(bgImage, 0, 0);
    }
	
	if (ballReady) {
        ctx.drawImage(ballImage, ball.x, ball.y);
    }
	
	if (paddleReady) {
        ctx.drawImage(paddleImage, paddle.x, paddle.y);
    }
	
	if(brickRedReady,brickOrangeReady,brickYellowReady,brickGreenReady,brickBlueReady)
	{
		for(var i = 0; i < bricks.length; i++)
		{
			if(bricks[i])
			{
				ctx.drawImage(bricks[i].image,bricks[i].x,bricks[i].y);
			}
		}
		
	}

    //score
    ctx.fillStyle = "#FFF";
    ctx.font = "20px Share Tech Mono";
    ctx.textAlign = "left";
    ctx.textBaseline = "top";
    ctx.fillText("SCORE: "+score, 8, HEIGHT-32);
    ctx.fillText("BALLS: "+balls, WIDTH*(3/4)+24, HEIGHT-32);
    //new game and pause screen

};


/************\
**   LOOP   **
\************/
function main()			
{
    var now = Date.now();
    var delta = now - then;

    update(delta / 1000);

    render();

    then = now;

    requestAnimationFrame(main);
};


//start game
var then = Date.now();
main();