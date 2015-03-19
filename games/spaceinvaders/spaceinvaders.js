/* filename:    spaceinvaders.js
 *
 * author:      Jacob Gray
 *
 * description: A clone of the game Space Invaders.
 * 
 */

/******************************************************************************\
*  -------------------------------  GLOBALS   -------------------------------  *
\******************************************************************************/
{
var WIDTH = 480;			//canvas size
var HEIGHT = 768;			//canvas size
var then = Date.now();		//stores the time of the last game cycle
var canvas = document.createElement("canvas");  //canvas element
var ctx = canvas.getContext("2d");				//context
var mouseX;					//holds mouse x position
var scale = WIDTH/WIDTH;					//scale factor of canvas
var score = 0;				//current score
var hiscore = 5;			//highest of last played scores
var level = 0;				//current set of bricks
var gameID = 2;

var pause = false;			//whether or not user has paused
var enterKeyHit = false;    //flag for enter key
var gameOver = false;		//whether or not currently game over
var newLevel = false;       //whether or not currently showing new level
var firstPlay = true;       //whether or not the player has played a game yet
var touchDrag = false;		//touch control flag

var aliens = [];			//holds alien objects
var lasers = [];			//holds alien bullets
var bullet;					//holds bullet objects
var ship = new Ship();		//ship object
var walls = [];				//holds wall objects
var frameFlag = true;   	//for alien animation
var spaceHit = false;    	//flag for space bar
var SHIPS = 3;				//
var ships = SHIPS;			//
var aliensHigh = 5;
var aliensWide = 8;
var bottomAliens = [];
var shipHitTimer = 0;

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
bgImage.src = "spaceinvaders/media/background.png";

var alienReady = false;
var alienImage = new Image();
alienImage.onload = function () {
    alienReady = true;
};
alienImage.src = "spaceinvaders/media/alien.png";

var alien2Ready = false;
var alien2Image = new Image();
alien2Image.onload = function () {
    alien2Ready = true;
};
alien2Image.src = "spaceinvaders/media/alien2.png";

var brickReady = false;
var brickImage = new Image();
brickImage.onload = function () {
    brickReady = true;
};
brickImage.src = "spaceinvaders/media/brick.png";

var bulletReady = false;
var bulletImage = new Image();
bulletImage.onload = function () {
    bulletReady = true;
};
bulletImage.src = "spaceinvaders/media/bullet.png";

var bullet2Ready = false;
var bullet2Image = new Image();
bullet2Image.onload = function () {
    bullet2Ready = true;
};
bullet2Image.src = "spaceinvaders/media/bullet2.png";

var shipReady = false;
var shipImage = new Image();
shipImage.onload = function () {
    shipReady = true;
};
shipImage.src = "spaceinvaders/media/ship.png";

var boomReady = false;
var boomImage = new Image();
boomImage.onload = function () {
    boomReady = true;
};
boomImage.src = "spaceinvaders/media/boom.png";

//load sound *******************************************************************
var shipBoom = new Audio("spaceinvaders/media/shipBoom.wav");
shipBoom.load();
var alienBoom = new Audio("spaceinvaders/media/alienBoom.wav");
alienBoom.load();
var alienZap = new Audio("spaceinvaders/media/alienZap.wav");
alienZap.load();
var zap = new Audio("spaceinvaders/media/zap.wav");
zap.load();

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
		spaceHit = true;
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
function Alien()
{
	this.height = 32;
	this.width = 32;
	this.y = 0;
	this.x = 0;
    this.speedX = .5;
    this.speedY = 15;
}

function Ship()
{
	this.height = 32;
	this.width = 32;
	this.y = HEIGHT-96;
	this.x = WIDTH/2-this.width/2;
}

function Bullet(ex,why,speed)
{
	this.height = 2;
	this.width = 2;
	this.y = why;
	this.x = ex;
	this.speedX = 0;
    this.speedY = speed;
}

function Wall(a,b)
{
	this.bricks = [];
	this.y = b;
	this.x = a;
	for(var i = 0; i<15;i++)
	{
		this.bricks[i] = new Brick();
		if(i === 0)
		{
			this.bricks[i].x = this.x+this.bricks[i].width;
			this.bricks[i].y = this.y;
		}
		else if(i === 3)
		{
			this.bricks[i].x = this.x;
			this.bricks[i].y = this.y + this.bricks[i].height;
		}
		else if(i === 8)
		{
			this.bricks[i].x = this.x;
			this.bricks[i].y = this.y + this.bricks[i].height*2;
		}
		else if(i === 13)
		{
			this.bricks[i].x = this.x;
			this.bricks[i].y = this.y + this.bricks[i].height*3;
		}
		else if(i === 14)
		{
			this.bricks[i].x = this.x+this.bricks[i].width*4;
			this.bricks[i].y = this.y + this.bricks[i].height*3;
		}
		else
		{
			this.bricks[i].x = this.bricks[i-1].x+this.bricks[i].width;
			this.bricks[i].y = this.bricks[i-1].y;
		}
	}
	
	this.height = this.bricks[0].height*4;
	this.width = this.bricks[0].width*5;
}

function Brick()
{
	this.height = 8;
	this.width = 8;
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
function contains(a, obj) {
    for (var i = 0; i < a.length; i++) {
        if (a[i] === obj) {
            return true;
        }
    }
    return false;
}

function newGame()
{
	score = 0;
    level = 0;
	ships = SHIPS;
    startNewLevel();
}

//startNewLevel is the perfect name for this function
function startNewLevel()
{
	var halfWall;		//store half wall width
	var wallY = HEIGHT - 128;
	
	level++;
	
	//time out the new level message
	setTimeout(function(){newLevel = false;}, 2000);
	
	//init walls
	for(var i = 0; i < 4; i++)
	{
		if(walls[i])
		{
			delete walls[i];
		}
	}

	walls[0] = new Wall(WIDTH/5 - 32,wallY);
	walls[1] = new Wall(WIDTH/5*2 - 32,wallY);
	walls[2] = new Wall(WIDTH/5*3 - 32,wallY);
	walls[3] = new Wall(WIDTH/5*4 - 32,wallY);
	
	//init aliens
	for(var i = 0; i < aliensHigh; i++)
	{
		aliens[i] = new Array();
		for(var j = 0; j < aliensWide; j++)
		{
			aliens[i][j] = new Alien();
			aliens[i][j].y = i*(aliens[i][j].height+8);
			aliens[i][j].x = j*(aliens[i][j].width+8);
		}
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
    var hitSide = false;        //if aliens hit side

    //handle enter key
	if(enterKeyHit)
	{
        enterKeyHit = false;
		if(firstPlay)
		{
			firstPlay = false;
			startNewLevel();
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
	
	if(shipHitTimer)
	{
		shipHitTimer -= modifier;
		if(shipHitTimer <= 0)
		{
			shipHitTimer = 0;
		}
	}
	
	//set ship to mouse
	if	((mouseX - canvas.offsetLeft)/scale > 0+ship.width/2 && 
		(mouseX - canvas.offsetLeft)/scale < WIDTH-ship.width/2 &&
		!shipHitTimer)
	{
		ship.x = ((mouseX - canvas.offsetLeft)/scale) - ship.width/2;
	}
	
	//if game is playing vs message displaying
	if(!gameOver && !firstPlay && !pause)
	{
        //move aliens
		aliensFound = false;
		for(var i = 0; i < aliensHigh; i++)
        {
			for(var j = 0; j < aliensWide; j++)
			{
				if(aliens[i][j])
				{
					aliensFound = true;
					aliens[i][j].x += aliens[i][j].speedX; 
					if(aliens[i][j].x <= 0 || aliens[i][j].x >= WIDTH-aliens[i][j].width)
					{
						hitSide = true;
					}
				}
			}
        }
		if(!aliensFound)
		{
			newLevel = true;
			startNewLevel();
		}
		
        if(hitSide)
        {
            for(var i = 0; i < aliensHigh; i++)
			{
				for(var j = 0; j < aliensWide; j++)
				{
					if(aliens[i][j])
					{
						aliens[i][j].speedX *= -1;
						aliens[i][j].y += aliens[i][j].speedY;
					}
				}
			}
        }
		
		//aliens shoot lasers
		bottomAliens = [];
		for(var i = 0; i < aliensWide; i++)
		{
			var lowest;
			for(var j = 0; j < aliensHigh; j++)
			{
				if(aliens[j][i])
				{
					lowest = aliens[j][i];
				}
			}
			bottomAliens.push(lowest);
		}
		
		for(var i = 0; i < bottomAliens.length; i++)
		{
			var rand = Math.floor((Math.random() * 1000));
			if(rand < 1 && bottomAliens[i])
			{
				lasers[lasers.length] = new Bullet(bottomAliens[i].x + bottomAliens[i].width/2, bottomAliens[i].y + bottomAliens[i].height, 5);
				alienZap.play();
			}
		}
		
		//spacebar fires bullet
		if(spaceHit && !bullet)
		{
			spaceHit = !spaceHit
			bullet = new Bullet(ship.x + ship.width/2 - 2,ship.y,-5);
			zap.play();
		}
		
		//handle bullet
		if(bullet)
		{
			bullet.y += bullet.speedY;
			
			for(var i = 0; i < aliensHigh; i++)
			{
				for(var j = 0; j < aliensWide; j++)
				{
					if(aliens[i][j] && bullet)
					{
						if(collides(bullet,aliens[i][j]))
						{
							bullet = 0;
							delete aliens[i][j]; //aliens[i].splice(j,1);
							alienBoom.play();
							score++;
							if(score > hiscore)
							{
								hiscore = score;
							}
						}
					}
				}
			}
			
			for(var j = 0; j < walls.length; j++)
			{
				for(var k = 0; k < walls[j].bricks.length; k++)
				{
					if(walls[j].bricks[k] && bullet)
					{
						if(collides(bullet, walls[j].bricks[k]))
						{
							bullet = 0;
							walls[j].bricks.splice(k,1);
						}
					}
				}
			}
			
			if(bullet && bullet.y < 0)
			{
				bullet = 0;
			}
		}
		
		//handle lasers
		for(var i = 0; i < lasers.length; i++)
		{
			if(lasers[i])
			{
				lasers[i].y += lasers[i].speedY;

				if(collides(lasers[i],ship))
				{
					lasers.splice(i,1);
					ships--;
					shipBoom.play()
					shipHitTimer = 2;
				}

				for(var j = 0; j < walls.length; j++)
				{
					for(var k = 0; k < walls[j].bricks.length; k++)
					{
						if(walls[j].bricks[k] && lasers[i])
						{
							if(collides(lasers[i], walls[j].bricks[k]))
							{
								lasers.splice(i,1);
								walls[j].bricks.splice(k,1);
							}
						}
					}
				}
				
				if(bullet && bullet.y < 0)
				{
					bullet = 0;
				}
			}
		}
		
		if(!ships)
		{			
			gameOver = true;
                       
            ajax_post();
			newGame();
			
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
	var txtGameName = "SPACE INVADERS";
	var txtScore  = "SCORE: "+score;
    var txtHiScore  = "HI-SCORE: "+hiscore;
    var txtGameOver = "GAME OVER";
    var txtGameOver2 = "CLICK TO PLAY AGAIN";
	var txtFirstPlay = "CLICK TO PLAY";
	var txtnewLevel = "LEVEL "+level;
	var txtPaused = "PAUSED";
	var txtShips = "SHIPS: "+ships;
	var txtInstruction = "HIT SPACE TO SHOOT";
	
	//so game resizes (somewhat) smoothly on window resize
	//resize();
	
	//draw images
    if (bgReady) 
	{
        ctx.drawImage(bgImage, 0, 0);
    }
	if (shipReady && boomReady) 
	{
		if(shipHitTimer)
		{
			ctx.drawImage(boomImage, ship.x, ship.y);
		}
		else
		{
			ctx.drawImage(shipImage, ship.x, ship.y);
		}
    }
	
	if (brickReady) 
	{
		for(var i = 0; i < walls.length; i++)
		{
			for(var j = 0; j < walls[i].bricks.length; j++)
			{
				ctx.drawImage(brickImage, walls[i].bricks[j].x, walls[i].bricks[j].y);
			}
		}
    }

	if (alienReady && alien2Ready) 
	{
		for(var i = 0; i < aliensHigh; i++)
        {
			for(var j = 0; j < aliensWide; j++)
			{
				if(!firstPlay && aliens[i][j])
				{
					if(aliens[i][j].x % 15 === 0)
					{
						frameFlag = !frameFlag;
					}
					if(frameFlag)
					{
						ctx.drawImage(alienImage, aliens[i][j].x, aliens[i][j].y);
					}
					else
					{
						ctx.drawImage(alien2Image, aliens[i][j].x, aliens[i][j].y);
					}
				}
			}
        }
	
    }
	
	if (bulletReady && bullet2Ready)
	{
		if(bullet)
		{
			ctx.drawImage(bullet2Image, bullet.x, bullet.y);
		}
		for(var i = 0; i < lasers.length; i++)
		{
			ctx.drawImage(bulletImage, lasers[i].x, lasers[i].y);
		}
	}
	
    //set font
    ctx.fillStyle = "#FFF";
    ctx.font = "20px Share Tech Mono";
    ctx.textAlign = "left";
    ctx.textBaseline = "top";

    //show score
    ctx.fillText(txtScore, 8, HEIGHT-32);
	
	//show hiscore
    ctx.fillText(txtHiScore, (WIDTH/2)-(ctx.measureText(txtHiScore).width/2), HEIGHT-32);
	
	//show ships
	ctx.fillText(txtShips, WIDTH-(ctx.measureText(txtShips).width) - 8, HEIGHT-32);
	
	//show gameover message
    if(gameOver)
    {
		ctx.fillText(txtGameOver,WIDTH/2-(ctx.measureText(txtGameOver).width/2),(HEIGHT/2)-32);
		ctx.fillText(txtGameOver2,WIDTH/2-(ctx.measureText(txtGameOver2).width/2),(HEIGHT/2));
    }
	
	//show new level message
    if(newLevel)
    {
		ctx.fillText(txtnewLevel,WIDTH/2-(ctx.measureText(txtnewLevel).width/2),(HEIGHT/2)-32);
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
//startNewLevel();

//game start
then = Date.now();
main();

function ajax_post()
{
	var hr = new XMLHttpRequest();                                
	hr.open("POST", "game.php", true);
	hr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
	
	hr.onreadystatechange = function()
	{
		if(hr.readyState == 4 && hr.status == 200){                        
			
		};
	};

	hr.send("score="+score+"&gameID="+gameID);  
}