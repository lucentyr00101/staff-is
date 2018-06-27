<link href="https://fonts.googleapis.com/css?family=Arvo" rel="stylesheet">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" media="all">

<style>
body {
	overflow: hidden;
	margin: 0;
	padding: 0;
}
body {
	background: url('{{ asset("img/error.png") }}');
	background-size: cover;
}

div.error {
	position: absolute;
	top: 20%;
	left: 10%;
}

div.error p {
	color: #fff;
	font-family: Arvo;
	font-size: 4em;
	text-align: center;
}

div.back-container {
	text-align: center;
}

div.back-container a {
	font-family: Arvo;
	padding: 10px 20px;
	border-radius: 5px;
	box-shadow: 3px 3px 10px #fff;
	text-decoration: none;
	color: #fff;
	font-size: 22px;
}

/* Buzz Out */ 
@-webkit-keyframes hvr-buzz-out {
	10% {
		-webkit-transform: translateX(3px) rotate(2deg);
		transform: translateX(3px) rotate(2deg);
	}
	20% {
		-webkit-transform: translateX(-3px) rotate(-2deg);
		transform: translateX(-3px) rotate(-2deg);
	}
	30% {
		-webkit-transform: translateX(3px) rotate(2deg);
		transform: translateX(3px) rotate(2deg);
	}
	40% {
		-webkit-transform: translateX(-3px) rotate(-2deg);
		transform: translateX(-3px) rotate(-2deg);
	}
	50% {
		-webkit-transform: translateX(2px) rotate(1deg);
		transform: translateX(2px) rotate(1deg);
	}
	60% {
		-webkit-transform: translateX(-2px) rotate(-1deg);
		transform: translateX(-2px) rotate(-1deg);
	}
	70% {
		-webkit-transform: translateX(2px) rotate(1deg);
		transform: translateX(2px) rotate(1deg);
	}
	80% {
		-webkit-transform: translateX(-2px) rotate(-1deg);
		transform: translateX(-2px) rotate(-1deg);
	}
	90% {
		-webkit-transform: translateX(1px) rotate(0);
		transform: translateX(1px) rotate(0);
	}
	100% {
		-webkit-transform: translateX(-1px) rotate(0);
		transform: translateX(-1px) rotate(0);
	}
}
@keyframes hvr-buzz-out {
	10% {
		-webkit-transform: translateX(3px) rotate(2deg);
		transform: translateX(3px) rotate(2deg);
	}
	20% {
		-webkit-transform: translateX(-3px) rotate(-2deg);
		transform: translateX(-3px) rotate(-2deg);
	}
	30% {
		-webkit-transform: translateX(3px) rotate(2deg);
		transform: translateX(3px) rotate(2deg);
	}
	40% {
		-webkit-transform: translateX(-3px) rotate(-2deg);
		transform: translateX(-3px) rotate(-2deg);
	}
	50% {
		-webkit-transform: translateX(2px) rotate(1deg);
		transform: translateX(2px) rotate(1deg);
	}
	60% {
		-webkit-transform: translateX(-2px) rotate(-1deg);
		transform: translateX(-2px) rotate(-1deg);
	}
	70% {
		-webkit-transform: translateX(2px) rotate(1deg);
		transform: translateX(2px) rotate(1deg);
	}
	80% {
		-webkit-transform: translateX(-2px) rotate(-1deg);
		transform: translateX(-2px) rotate(-1deg);
	}
	90% {
		-webkit-transform: translateX(1px) rotate(0);
		transform: translateX(1px) rotate(0);
	}
	100% {
		-webkit-transform: translateX(-1px) rotate(0);
		transform: translateX(-1px) rotate(0);
	}
}

.hvr-buzz-out {
	display: inline-block;
	vertical-align: middle;
	-webkit-transform: perspective(1px) translateZ(0);
	transform: perspective(1px) translateZ(0);
	box-shadow: 0 0 1px transparent;
}

.hvr-buzz-out:hover, .hvr-buzz-out:focus, .hvr-buzz-out:active {
	-webkit-animation-name: hvr-buzz-out;
	animation-name: hvr-buzz-out;
	-webkit-animation-duration: 0.75s;
	animation-duration: 0.75s;
	-webkit-animation-timing-function: linear;
	animation-timing-function: linear;
	-webkit-animation-iteration-count: 1;
	animation-iteration-count: 1;
}

/* Shutter In Vertical */
.hvr-shutter-in-vertical {
	display: inline-block;
	vertical-align: middle;
	-webkit-transform: perspective(1px) translateZ(0);
	transform: perspective(1px) translateZ(0);
	box-shadow: 0 0 1px transparent;
	position: relative;
	background: #3f104c;
	-webkit-transition-property: color;
	transition-property: color;
	-webkit-transition-duration: 0.3s;
	transition-duration: 0.3s;
}
.hvr-shutter-in-vertical:before {
	content: "";
	position: absolute;
	z-index: -1;
	top: 0;
	bottom: 0;
	left: 0;
	right: 0;
	background: #7e508c;
	-webkit-transform: scaleY(1);
	transform: scaleY(1);
	-webkit-transform-origin: 50%;
	transform-origin: 50%;
	-webkit-transition-property: transform;
	transition-property: transform;
	-webkit-transition-duration: 0.3s;
	transition-duration: 0.3s;
	-webkit-transition-timing-function: ease-out;
	transition-timing-function: ease-out;
}
.hvr-shutter-in-vertical:hover, .hvr-shutter-in-vertical:focus, .hvr-shutter-in-vertical:active {
	color: white;
}
.hvr-shutter-in-vertical:hover:before, .hvr-shutter-in-vertical:focus:before, .hvr-shutter-in-vertical:active:before {
	-webkit-transform: scaleY(0);
	transform: scaleY(0);
}

</style>

<body>
	<div class='error'>
		<p>OOPS!</p>
		<p>PAGE NOT FOUND!</p>	
		<div class="back-container">
			<a href="{{ URL::previous() }}" class='hvr-buzz-out hvr-shutter-in-vertical hvr-curl-top-left'>Go Back</a>
		</div>	
	</div>
</body>