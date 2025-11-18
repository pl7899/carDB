<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Responsive Image Container</title>

<style>
  .image-container {
    display: flex;
    height: 150px;             /* Fixed height for container */
    gap: 18px;                  /* Space between images */
  }
  .image-container img {
    height: 100%;              /* Make images fit container height */
    flex-shrink: 1;            /* Allow shrinking */
    width: auto;               /* Maintain aspect ratio */
    object-fit: contain;
  }
  .lineHorizontal {
    border-top: 1px solid #000;
    border-boottom: 1px solid #000;
    width: 100%;
    height: 5px;
  }	
</style>

</head>

<body>
	
<div class="image-container">
  <button style="width: 200px; height: 150px;">Add Car</button>    
  <img src="https://picsum.photos/400/300" alt="1" />
  <img src="https://picsum.photos/100/150" alt="2" />
  <img src="https://picsum.photos/300/300" alt="3" />
  <img src="https://picsum.photos/200/300" alt="4" />
  <img src="https://picsum.photos/300/200" alt="5" />
  <img src="https://picsum.photos/300/200" alt="5" />
  <img src="https://picsum.photos/400/200" alt="5" />
  <img src="https://picsum.photos/300/500" alt="5" />
  <img src="https://picsum.photos/300/600" alt="5" />
  <img src="https://picsum.photos/300/700" alt="5" />
  <!-- Add up to 15 images similarly -->
</div>

<hr class="lineHorizontal">   

</body>

</html>