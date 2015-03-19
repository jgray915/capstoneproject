/* filename:    helicopter.js
 *
 * author:      Jacob Gray
 *
 * description: A clone of the game Helicopter.
 * 
 */

/******************************************************************************\
*  -------------------------------  GLOBALS   -------------------------------  *
\******************************************************************************/
{
var WIDTH = 800;			//canvas size
var HEIGHT = 500;			//canvas size
var then = Date.now();		//stores the time of the last game cycle
var canvas = document.createElement("canvas");  //canvas element
var ctx = canvas.getContext("2d");				//context
var mouseX;					//holds mouse x position
var scale = WIDTH/WIDTH;					//scale factor of canvas
var score;				//current score
var hiscore = 5;			//highest of last played scores
var level = 0;				//current set of bricks
var gameID = 3;


var pause = false;			//whether or not user has paused
var enterKeyHit = false;    //flag for enter key
var gameOver = false;		//whether or not currently game over
var newLevel = false;       //whether or not currently showing new level
var firstPlay = true;       //whether or not the player has played a game yet
var touchDrag = false;		//touch control flag

var heli = new Helicopter();
var a = 0;	//accumulator
var block = 0;
var bricks = [];
var ceiling = [];
var floor = [];
var spaceIsDown = false;
var crash = false;
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
bgImage.src = "helicopter/media/background.png";

var bgReady2 = false;
var bgImage2 = new Image();
bgImage2.onload = function () {
    bgReady2 = true;
};
bgImage2.src = "helicopter/media/background2.png";

var blockReady = false;
var blockImage = new Image();
blockImage.onload = function () {
    blockReady = true;
};
blockImage.src = "helicopter/media/block.png";

var heliReady = false;
var heliImage = new Image();
heliImage.onload = function () {
    heliReady = true;
};
heliImage.src = "helicopter/media/heli.png";

var boomReady = false;
var boomImage = new Image();
boomImage.onload = function () {
    boomReady = true;
};
boomImage.src = "helicopter/media/boom.png";

//load sound *******************************************************************
var bang = new Audio("helicopter/media/crash.wav");
bang.load();

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

document.addEventListener("keydown", function (e) {
	if(e.keyCode == 32)
	{
		spaceIsDown = true;
	}
}, false);

document.addEventListener("keyup", function (e) {
	if(e.keyCode == 32)
	{
		spaceIsDown = false;
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
var backgrounds = [0,WIDTH,WIDTH*2];
var backgrounds2 = [0,WIDTH,WIDTH*2];

var shapes = 	[
						[	[1,1,1,1,1,1,1,1],
							[0,1,1,1,1,1,1,0],
							[0,0,1,1,1,1,0,0],
							[0,0,0,1,1,0,0,0],
							[0,0,0,0,0,0,0,0],
							[0,0,0,0,0,0,0,0],
							[0,0,0,0,0,0,0,0],
							[0,0,0,0,0,0,0,0]],
							
						[	[0,0,0,0,0,0,0,0],
							[0,0,0,0,0,0,0,0],
							[0,0,0,0,0,0,0,0],
							[0,0,0,0,0,0,0,0],
							[0,0,0,1,1,0,0,0],
							[0,0,0,1,1,0,0,0],
							[0,0,0,1,1,0,0,0],
							[0,0,0,1,1,0,0,0]],
							
						[	[0,0,0,0,0,0,0,0],
							[0,0,0,0,0,0,0,0],
							[0,0,0,0,0,0,0,0],
							[0,0,0,0,0,0,0,0],
							[0,0,0,1,1,0,0,0],
							[0,0,1,1,1,1,0,0],
							[0,1,1,1,1,1,1,0],
							[1,1,1,1,1,1,1,1]],
							
						[	[0,0,0,1,1,0,0,0],
							[0,0,0,1,1,0,0,0],
							[0,0,0,1,1,0,0,0],
							[0,0,0,1,1,0,0,0],
							[0,0,0,0,0,0,0,0],
							[0,0,0,0,0,0,0,0],
							[0,0,0,0,0,0,0,0],
							[0,0,0,0,0,0,0,0]]
						];
						
//classes are implemented as functions in js
function Helicopter()
{
	this.height = 50;
	this.width = 100;
	this.y = HEIGHT/2;
	this.x = WIDTH/10;
	this.speedX = 350;
	this.speedY = 2;
}

function Block()
{
	this.shape = shapes[Math.floor(Math.random() * shapes.length)];
	this.y = 0;
	this.x = WIDTH;
	this.width = this.shape[0].length*50;
}

function Brick(X, Y)
{
	this.x = X
	this.y = Y
	this.height = 50;
	this.width = 50;
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
    var RATIO = WIDTH/HEIGHT;
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
	heli = new Helicopter();
	
	for(var i = 0; i < bricks.length; i++)
	{
		bricks[i] = 0;
	}
	for(var i = 0; i < WIDTH/50; i++)
	{
		ceiling[i] = new Brick(i*50,0);
		floor[i] = new Brick(i*50,HEIGHT-50);
	}
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
			crash = false;
			newGame();
		}
		else
		{
			pause = !pause;
		}
	}
	
	//if game is playing vs message displaying
	if(!gameOver && !firstPlay && !pause)
	{
		score++;
		if(hiscore <= score)
		{
			hiscore = score;
		}
		
		a += heli.speedX*modifier;
		if(a >= 400)
		{
			a = 0;
			block = new Block();
			var first = true;
			for(var i = 0; i < block.shape.length; i++)
			{
				for(var j = 0; j < block.shape[i].length; j++)
				{
					if(block.shape[i][j] == 1)
					{
						bricks[bricks.length] = new Brick(block.x+(j*50), block.y+((i+1)*50));
						if(first)
						{
							bricks[bricks.length] = new Brick(block.x+(j*50), block.y+((i+1)*50));
							first = false;
						}
					}
				}
			}
			block = 0;
		}
		
		for(var i = 0; i < backgrounds.length; i++)
		{
			backgrounds[i] -= heli.speedX*modifier;
			backgrounds2[i] -= 175 *modifier;
		}
		if(backgrounds[1] <= 0)
		{
			backgrounds.splice(0,1);
			backgrounds[2] = backgrounds[1]+WIDTH;
		}
		if(backgrounds2[1] <= 0)
		{
			backgrounds2.splice(0,1);
			backgrounds2[2] = backgrounds2[1]+WIDTH;
		}

		
		for(var i = 0; i < bricks.length; i++)
		{
			bricks[i].x -= heli.speedX*modifier;
			if(bricks[i].x <= 0-bricks[i].width)
			{
				bricks.splice(i,1);
			}
			if(collides(heli, bricks[i]) && !crash)
			{
				bang.play();
				gameOver = true;
				ajax_post();
				crash = true;
				heli.speedX = 0;
				heli.speedY = 0;
				score = 0;
			}
		}

		for(var i = 0; i < ceiling.length; i++)
		{
			if(collides(heli, ceiling[i]) || collides(heli, floor[i]) && !crash)
			{
				bang.play();
				gameOver = true;
                ajax_post();
				crash = true;
				heli.speedX = 0;
				heli.speedY = 0;
				score = 0;
			}
		}
		
		if(spaceIsDown)
		{
			heli.y -= heli.speedY+1;
		}
		else
		{
			heli.y += heli.speedY+1;
		}
		
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
    var txtGameOver2 = "CLICK TO PLAY AGAIN";
	var txtFirstPlay = "CLICK TO PLAY";
	var txtnewLevel = "LEVEL "+level;
	var txtPaused = "PAUSED";
	var txtGameName = "HELICOPTER";
	var txtInstruction = "HIT SPACE TO CLIMB";
	
	//so game resizes (somewhat) smoothly on window resize
	//resize();
	
	//draw images
    if(bgReady) 
	{
		for(var i = 0; i < backgrounds2.length; i++)
		{
			ctx.drawImage(bgImage2, backgrounds2[i], 0);
		}
		for(var i = 0; i < backgrounds.length; i++)
		{
			ctx.drawImage(bgImage, backgrounds[i], 0);
		}
    }
	
	if(blockReady)
	{
		// for(var i = 0; i < WIDTH/50; i++)	//ceiling/floor
		// {
			// ctx.drawImage(blockImage, ceiling[i].x, ceiling[i].y);
			// ctx.drawImage(blockImage, floor[i].x, floor[i].y);
		// }
		
		for(var i = 0; i < bricks.length; i++)
		{
			if(bricks[i] != 0)
			{
				ctx.drawImage(blockImage, bricks[i].x, bricks[i].y);
			}
		}
	}
	
	if(heliReady && !crash)
	{
		ctx.drawImage(heliImage, heli.x, heli.y);
	}
	else if(boomReady)
	{
		ctx.drawImage(boomImage, heli.x, heli.y);
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
		ctx.font = "40px Share Tech Mono";
		ctx.fillText(txtGameName,WIDTH/2-(ctx.measureText(txtGameName).width/2),(HEIGHT/4));
		ctx.font = "20px Share Tech Mono";
		ctx.fillText(txtFirstPlay,WIDTH/2-(ctx.measureText(txtFirstPlay).width/2),(HEIGHT/2)-32);
		ctx.fillText(txtInstruction,WIDTH/2-(ctx.measureText(txtInstruction).width/2),(HEIGHT/2));
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
//window.addEventListener('resize', resize(), false);		//doesn't work, resize() runs in render()

//game init
newGame();

//game start
then = Date.now();
main();

function ajax_post(){
                var hr = new XMLHttpRequest();                                
                hr.open("POST", "game.php", true);
                hr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
                hr.onreadystatechange = function(){
                    if(hr.readyState == 4 && hr.status == 200){                        
                        
                        
                        };
                    };
                
                hr.send("score="+score+"&gameID="+gameID);                
            }