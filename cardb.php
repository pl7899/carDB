<?php echo "
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Responsive Image Container</title>
<style>
  .image-container {
    display: flex;
    flex-wrap: nowrap;         /* Keep images in single row */
    overflow-x: auto;          /* Scroll if overflow */
    height: 150px;             /* Fixed height for container */
    gap: 8px;                  /* Space between images */
  }
  .image-container img {
    height: 100%;              /* Make images fit container height */
    flex-shrink: 1;            /* Allow shrinking */
    width: auto;               /* Maintain aspect ratio */
    object-fit: contain;
  }
</style>
</head>
<body>

<div class="image-container">
  <img src="https://via.placeholder.com/200x150?text=1" alt="1" />
  <img src="https://via.placeholder.com/150x150?text=2" alt="2" />
  <img src="https://via.placeholder.com/180x150?text=3" alt="3" />
  <img src="https://via.placeholder.com/160x150?text=4" alt="4" />
  <img src="https://via.placeholder.com/140x150?text=5" alt="5" />
  <!-- Add up to 15 images similarly -->
</div>

</body>
</html>

"; ?>
