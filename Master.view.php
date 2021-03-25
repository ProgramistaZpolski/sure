<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sure</title>
	<style>
		body {
			line-height: 1.5;
			margin: 0;
			font-family: 'Ubuntu', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, "Helvetica Now Text", "Helvetica Neue", "Helvetica", Cantarell, Oxygen, Arial, Tahoma, Geneva, Verdana, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
		}

		main {
			position: absolute;
			top: 15%;
			left: 50%;
			margin-right: -50%;
			transform: translate(-50%, 0%);
			background-color: #fff;
			padding: 3rem;
			border-radius: .25rem;
		}

		.bg {
			position: absolute;
			z-index: -1;
			width: 100%;
			height: 100%;
			filter: hue-rotate(60deg);
			background-size: 100%;
			<?= $bg ?>
		}

		@keyframes success {
			to {
				filter: hue-rotate(0deg);
			}
		}

		@keyframes fail {
			to {
				filter: hue-rotate(200deg);
			}
		}

		.success {
			animation: success 1.5s linear 0s 1 forwards;
		}

		.fail {
			animation: fail 1.5s linear 0s 1 forwards;
		}

		.templatediv {
			display: flex;
		}

		.templatediv * {
			padding: .5rem;
			background-color: #4F46E5;
			color: white;
			border: 1px solid rgba(0, 0, 0, .2);
		}
	</style>
</head>

<body>
	<div aria-hidden="true" class="bg"></div>
	<main>
		<h1>Sure</h1>
		<template>
			<div class="templatediv">
				<p data-url>URL</p>
				<p data-status>...</p>
				<p data-works>In Progress...</p>
			</div>
		</template>
	</main>
	<script defer>
		"use strict";
		const data = <?= $data ?>;
		const template = document.querySelector("template");
		let i = 0;
		let wins = 0;
		data.forEach(el => {
			const templateElement = template.content.cloneNode(true);
			templateElement.querySelector("[data-url]").innerText = el.url;
			templateElement.querySelector("[data-url]").setAttribute("data-url", i);
			templateElement.querySelector("[data-status]").innerText = `Expects: ${el.status}`;
			templateElement.querySelector("[data-status]").setAttribute("data-status", i);
			templateElement.querySelector("[data-works]").setAttribute("data-works", i);
			document.querySelector("main").appendChild(templateElement);
			fetch(`${el.url}?sureid=${i}`).then(resp => {
				let i = resp.url.split("?sureid=")[1];
				document.querySelector(`[data-status="${i}"]`).innerText = `Expects: ${el.status} / Recived: ${resp.status}`;
				document.querySelector(`[data-works="${i}"]`).innerText = el.status == resp.status ? "Passed" : "Failed";
				if (el.status == resp.status) {
					wins++;
					document.querySelector(`[data-works="${i}"]`).style.backgroundColor = `#059669`;
				} else {
					document.querySelector(`[data-works="${i}"]`).style.backgroundColor = `#DC2626`;
				};
				if (wins >= data.length) {
					document.querySelector(".bg").classList.add("success");
					document.querySelector(".bg").classList.remove("fail");
				} else {
					document.querySelector(".bg").classList.remove("success");
					document.querySelector(".bg").classList.add("fail");
				};
			});
			i++;
		});
	</script>
</body>

</html>