/* filename:    breakout.js
 * author:      Jacob Gray
 * description: A clone of the game Breakout.
 * 
 * TODO:
 * TEST TAPPING
 * fix aspect
 */

/******************************************************************************\
*  -------------------------------  GLOBALS   -------------------------------  *
\******************************************************************************/
{
var WIDTH = 480;			//canvas size
var HEIGHT = 640;			//canvas size
var then = Date.now();		//stores the time of the last game cycle
var canvas = document.createElement("canvas");  //canvas element
var ctx = canvas.getContext("2d");				//context
var mouseX;					//holds mouse x position
var scale;					//scale factor of canvas
var score = 0;				//current score
var hiscore = 5;			//highest of last played scores
var level = 0;				//current set of bricks


var pause = false;			//whether or not user has paused
var enterKeyHit = false;    //flag for enter key
var gameOver = false;		//whether or not currently game over
var newLevel = false;       //whether or not currently showing new level
var firstPlay = true;       //whether or not the player has played a game yet
var touchDrag = false;		//touch control flag

//cross-browser support
var w = window;
requestAnimationFrame = w.requestAnimationFrame || 
                        w.webkitRequestAnimationFrame || 
                        w.msRequestAnimationFrame || 
                        w.mozRequestAnimationFrame;

//hide mobile address bar
var ua = navigator.userAgent.toLowerCase();
var android = ua.indexOf('android') > -1 ? true : false;
var ios = ( ua.indexOf('iphone') > -1 || ua.indexOf('ipad') > -1  ) ? true : false;
}
/******************************************************************************\
*  ------------------------------  LOAD MEDIA  ------------------------------  *
\******************************************************************************/
{
//load images*******************************************************************
var bgReady = false;
var bgImage = new Image();
bgImage.onload = function () {
    bgReady = true;
};
bgImage.src = "media/background.png";

//load sound *******************************************************************
var noise = new Audio("media/noise.wav");
noise.load();

}
/******************************************************************************\
*  ----------------------------  INPUT HANDLING  ----------------------------  *
\******************************************************************************/
{
document.addEventListener("keydown", function (e) {
	if(e.keyCode == 13)
	{
		enterKeyHit = true;
	}
}, false);

//listen for mouse movement
document.addEventListener("mousemove", function (e) {
    if(!e)
	{
		var e = event;
	}
	mouseX = e.pageX;
}, false);

//listen for clicks
window.addEventListener('click', function(e) {
    enterKeyHit = true;
}, false);

//listen for touches
window.addEventListener('touchstart', function(e) {
	e.preventDefault(); 
	//if the touch ends in 200mS, it was a tap?
	setTimeout(function (){
        if (!touchStarted){
            enterKeyHit = true;
        }
    },200);
}, false);

window.addEventListener('touchmove', function(e) {
	e.preventDefault(); 
	touchDrag = true;
    mouseX = e.changedTouches[0].clientX;
}, false);

window.addEventListener('touchend', function(e) {
	e.preventDefault(); 
	touchDrag = false;
}, false);


}
/******************************************************************************\
*  -------------------------------  OBJECTS   -------------------------------  *
\******************************************************************************/
{
//classes are implemented as functions in js
function Thing()
{
	this.height = 0;
	this.width = 0;
	this.y = 0;
	this.x = 0;
}

}
/******************************************************************************\
*  ------------------------------  FUNCTIONS   ------------------------------  *
\******************************************************************************/
{

//canvas functions *************************************************************
function init()
{
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
		src: local('Share Tech Mono'), local('ShareTechMono-Regular'), \n\
        url(http://fonts.gstatic.com/s/sharetechmono/v4/RQxK-3RA0Lnf3gnnnNrAsYdJ2JT0J65PSe7wdxAnx_I.woff2) \n\
        format('woff2'); \n\
		unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, \n\
        U+2000-206F, U+2074, U+20AC, U+2212, U+2215, U+E0FF, U+EFFD, U+F000;}"
		));
    document.head.appendChild(newStyle);
}

//called by init and render, resizes canvas to window
function resize()
{
    var RATIO = 10/16;          //canvas WIDTH/HEIGHT
    var CURR_WIDTH = WIDTH;     //resize canvas
    var CURR_HEIGHT = HEIGHT;   //resize canvas

    //resize width in proportion to height
    CURR_HEIGHT = window.innerHeight;
    CURR_WIDTH = CURR_HEIGHT * RATIO;
	
    if(CURR_WIDTH > window.innerWidth)
    {
        CURR_WIDTH = window.innerWidth;
        CURR_HEIGHT = CURR_WIDTH / RATIO;
    }

    //some extra space to scroll past the address bar
    if (android || ios) 
    {
        //document.body.style.height = (window.innerHeight + 50) + 'px';
    }

    //scale it with CSS
    canvas.style.width = CURR_WIDTH + 'px';
    canvas.style.height = CURR_HEIGHT + 'px';
    //some mobile browsers don't fire without a delay
    window.setTimeout(function() 
    {
        window.scrollTo(0,1);
    }, 1);
	
	scale = CURR_WIDTH/WIDTH;
}


//game functions ***************************************************************
function newGame()
{
	score = 0;
    level = 0;
    startNewLevel();
}

//startNewLevel is the perfect name for this function
function startNewLevel()
{
	level++;
	
	//time out the new level message
	setTimeout(function(){newLevel = false;}, 2000);
}

//collision handling ***********************************************************
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

//returns if obj1 hit obj2 on "top", "bottom", "left", or "right"
function collisionDirection(obj1, obj2)
{
	var obj1Bottom = obj1.y + obj1.height;
	var obj2Bottom = obj2.y + obj2.height;
	var obj1Right = obj1.x + obj1.width;
	var obj2Right = obj2.x + obj2.width;
	
	var collB = obj2Bottom - obj1.y;
	var collT = obj1Bottom - obj2.y;
	var collL = obj1Right - obj2.x;
	var collR = obj2Right - obj1.x;
	
	if(collT < collB &&
		collT < collL &&
		collT < collR)
	{
		return "top";
	}
	if(collL < collR &&
		collL < collT &&
		collL < collB)
	{
		return "left";
	}
	if(collR < collB &&
		collR < collL &&
		collR < collT)
	{
		return "right";
	}
	if(collB < collT &&
		collB < collL &&
		collB < collR)
	{
		return "bottom";
	}
}

}
/******************************************************************************\
*  --------------------------------  UPDATE  --------------------------------  *
\******************************************************************************/
//game logic runs here
function update(modifier) 
{
    //handle enter key
	if(enterKeyHit)
	{
        enterKeyHit = false;
		if(firstPlay)
		{
			firstPlay = false;
		}
		else if(gameOver)
		{
			gameOver = false;
		}
		else
		{
			pause = !pause;
		}
	}
	
	//if game is playing vs message displaying
	if(!gameOver && !firstPlay && !pause)
	{
		
	}
}
/******************************************************************************\
*  --------------------------------  RENDER  --------------------------------  *
\******************************************************************************/
//game drawing runs here
function render() 
{
    //text to render
	var txtScore  = "SCORE: "+score;
    var txtHiScore  = "HI-SCORE: "+hiscore;
    var txtGameOver = "GAME OVER";
    var txtGameOver2 = "CLICK OR TAP TO PLAY AGAIN";
	var txtFirstPlay = "CLICK OR TAP TO PLAY";
	var txtnewLevel = "LEVEL "+level;
	var txtPaused = "PAUSED";
	
	//so game resizes (somewhat) smoothly on window resize
	resize();
	
	//draw images
    if (bgReady) 
	{
        ctx.drawImage(bgImage, 0, 0);
    }
	
    //set font
    ctx.fillStyle = "#FFF";
    ctx.font = "20px Share Tech Mono";
    ctx.textAlign = "left";
    ctx.textBaseline = "top";

    //show score
    ctx.fillText(txtScore, 8, HEIGHT-32);
	
	//show hiscore
	txtHiScore
    ctx.fillText(txtHiScore, (WIDTH/2)-(ctx.measureText(txtHiScore).width/2), HEIGHT-32);
	
	//show gameover message
    if(gameOver)
    {
		ctx.fillText(txtGameOver,WIDTH/2-(ctx.measureText(txtGameOver).width/2),(HEIGHT/2)-32);
		ctx.fillText(txtGameOver2,WIDTH/2-(ctx.measureText(txtGameOver2).width/2),(HEIGHT/2));
    }
	
	//show new level message
    if(newLevel)
    {
		ctx.fillText(txtnewLevel,WIDTH/2-(ctx.measureText(txtnewLevel).width/2),8);
    }
	
	//show first play message
	if(firstPlay)
    {
		ctx.fillText(txtFirstPlay,WIDTH/2-(ctx.measureText(txtFirstPlay).width/2),(HEIGHT/2)-32);
    }
	
	//show pause message
	if(pause)
    {
		ctx.fillText(txtPaused,WIDTH/2-(ctx.measureText(txtPaused).width/2),(HEIGHT/2)-32);
    }
};
/******************************************************************************\
*  ---------------------------------  MAIN  ---------------------------------  *
\******************************************************************************/
function main()			
{
    var now = Date.now();		//time of current game cycle
    var delta = now - then;		//delta == difference in time

    update(delta / 1000);
    render();

    then = now;

    requestAnimationFrame(main);
};

//more handlers
window.addEventListener('load', init(), false);
window.addEventListener('resize', resize(), false);		//doesn't work, resize() runs in render()

//game init
startNewLevel();

//game start
then = Date.now();
main();