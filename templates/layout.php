<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>I.E.P. Juan Pablo II - Jaen</title>
		<meta name="description" content="La Institucion Educativa Juan Pablo II de Jaen, El arte de enseñar con amor">
		<meta name="keywords" content="Colegio, Educativa, Institucion Educativa, Juan Pablo, Jaen, Peru" />
		<meta name="robots" content="index,follow"><!-- All Search Engines -->
		<meta name="googlebot" content="index,follow"><!-- Google Specific -->
		<meta name="author" content="Dennis Andres Infantas Reaño" />
		<meta name="google-site-verification" content="VEyfl7BTpJleZeIlVInY7ItTzlfYI0yFup-ovJjtG4E" />
		<link href="https://fonts.googleapis.com/css?family=Raleway:400, 600&display=swap" rel="stylesheet" />
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
		<link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="assets/css/styles.min.css" />
		<link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css" />

	</head>
	<body class="leading-normal tracking-normal text-white gradient" style="font-family: 'Raleway';">
		<!--Nav-->
		<nav id="header" class="fixed w-full z-30 top-0 text-white bg-blue-900">
			<div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 py-2">
				<div class="pl-4 flex items-center">
					<a class="toggleColour text-white no-underline hover:no-underline font-bold text-2xl lg:text-4xl" href="#top">
						<!--Icon from: http://www.potlabicons.com/ -->
						<img class="h-8 fill-current inline" src="assets/images/logo-h50.svg" /> 
							I.E.P. Juan Pablo II
					</a>
				</div>

				<div class="block lg:hidden pr-4">
					<button id="nav-toggle" class="flex items-center px-3 py-2 border rounded text-gray-500 border-gray-600 hover:text-blue-300 hover:border-teal-500 appearance-none focus:outline-none">
						<svg
							class="fill-current h-3 w-3"
							viewBox="0 0 20 20"
							xmlns="http://www.w3.org/2000/svg" >
						<title>Menu</title>
						<path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
					</svg>
				</button>
			</div>

			<div class="w-full flex-grow lg:flex lg:items-center lg:w-auto hidden lg:block mt-2 lg:mt-0 bg-blue-900 lg:bg-transparent text-black p-4 lg:p-0 z-20" id="nav-content">
				<ul class="list-reset lg:flex justify-end flex-1 items-center">
					<li class="mr-3">
						<a class="inline-block py-2 px-4 text-white no-underline hover:text-blue-300 hover:font-bold self-center"
							href="/nosotros.html">
							Conózcanos
					</a>
				</li>
				<li class="mr-3">
					<a class="inline-block text-white no-underline hover:text-blue-300 hover:font-bold py-2 px-4"
						href="/servicios.html">
						Servicios </a>
				</li>
				<li class="mr-3">
					<a class="inline-block text-white no-underline hover:text-blue-300 hover:font-bold py-2 px-4" href="#contactenos" >Contactenos</a>
				</li>
				<li class="mr-3">
					<a class="inline-block text-white no-underline hover:text-blue-300 hover:font-bold py-2 px-4" href="#aula" > Aula Virtual </a>
				</li>
			</ul>
		</div>
	</div>

	<hr class="border-b border-gray-100 opacity-25 my-0 py-0" />
</nav>

		<?=$content?>
	</body>
</html>
