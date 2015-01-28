var WIDTH = 320;
var HEIGHT = 336;
var canvas = null;
var ctx = null;
var RATIO = null;
var CURR_WIDTH = null;
var CURR_HEIGHT = null;
var a = 0;	//accumulates fractions of  a second

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
bgImage.src = "media/background2.png";		//#95c899 #1b321d

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
    document.body.style.backgroundColor = "#000";
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
}


function resize()
{
    //resize width in proportion to height
    CURR_HEIGHT = window.innerHeight;
    CURR_WIDTH = CURR_HEIGHT * RATIO;
    if(CURR_WIDTH > window.innerWidth)
    {
        CURR_WIDTH = window.innerWidth;
        CURR_HEIGHT = CURR_WIDTH * RATIO;
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
    
    if (lastDown === 38 && prevDown !== 40) { //up
        if(a>1)
        snake.y -= snake.speed;
    snake.body.unshift({x: snake.x, y: snake.y});
    snake.body.pop();
    }
    else if (lastDown === 40 && prevDown !== 38) { //down
        if(a>1)
        snake.y += snake.speed;
    snake.body.unshift({x: snake.x, y: snake.y});
    snake.body.pop();
    }
    else if (lastDown === 37 && prevDown !== 39) { //left
        if(a>1)
        snake.x -= snake.speed;
    snake.body.unshift({x: snake.x, y: snake.y});
    snake.body.pop();
    }
    else if (lastDown === 39 && prevDown !== 37) { //right
        if(a>1)
        snake.x += snake.speed;
    snake.body.unshift({x: snake.x, y: snake.y});
    snake.body.pop();
    }
    else if(lastDown === 13)    //enter
    {
        paused = true;
    }
    else
    {
        lastDown = prevDown;
    }

    if(a>1)
    {
        a = 0;
    }

    //apple collision detection
    if (snake.x <= apple.x && 
        apple.x <= snake.x && 
        snake.y <= apple.y && 
        apple.y <= snake.y) 
    {
        applesEaten++;
        
        for(var i = 15; i>0; i--)   //TODO this is an ugly broken fix
        { 
            snake.body.unshift({x: snake.x, y: snake.y});
        }
        
        newApple();
    }
    
    //wall collision
    if( snake.x > 304 ||
        snake.x < 0 ||
        snake.y > 320 ||
        snake.y < 16)
    {
        objectHit = "the wall";
        newGame = true;
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

    if (snakeReady) {
        ctx.drawImage(snakeImage, snake.x, snake.y);
        for(var i = 0; i<snake.body.length; i++)	
        {
            ctx.drawImage(snakeImage, snake.body[i].x, snake.body[i].y);
        }
    }

    if (appleReady) {
        ctx.drawImage(appleImage, apple.x, apple.y);
    }

    //score
    ctx.fillStyle = "#1b321d";
    ctx.font = "12px Share Tech Mono";
    ctx.textAlign = "left";
    ctx.textBaseline = "top";
    ctx.fillText("SCORE: " + applesEaten, 1, 1);
    
    //new game and pause screen
    if(newGame)
    {
        ctx.fillText("You hit "+objectHit+".",WIDTH/8*3,HEIGHT/2-14);
        ctx.fillText("Final score is "+applesEaten, WIDTH/8*3,HEIGHT/2);
        ctx.fillText("Press Enter",WIDTH/8*3,HEIGHT/2+14);
        if(lastDown === 13) //enter
        {
            newGame = false;
            gameover();
        }
    }
    else if(paused)
    {
        ctx.fillText("Paused", WIDTH/8*3,HEIGHT/2);
        ctx.fillText("Press Enter",WIDTH/8*3,HEIGHT/2+14);
        if(lastDown === 13) //enter
        {
            paused = false;
        }
    }
};


/************\
**   LOOP   **
\************/
function main()			
{
    var now = Date.now();
    var delta = now - then;
    
    if(!newGame)
    {
        update(delta / 1000);
    }
    render();

    then = now;

    requestAnimationFrame(main);
};


//start game
var then = Date.now();
main();