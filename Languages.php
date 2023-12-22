<?php

echo '  <div class="slider-container">
<div class="slider">
  <!-- Add as many cards as needed -->
  <div class="card">
    <img src="https://source.unsplash.com/random?programming-python-200x200">
    <div class="card-content">
      <!-- Content for the first card -->
      <h3>Card 1</h3>
      <p>Content for Card 1.</p>
    </div>
  </div>

  <div class="card">
    <img src="images/java.jpg" alt="Image 2">
    <div class="card-content">
      <!-- Content for the second card -->
      <h3>Card 2</h3>
      <p>Content for Card 2.</p>
    </div>
  </div>
  <div class="card">
    <img src="https://source.unsplash.com/random?programming-c++" alt="Image 2">
    <div class="card-content">
      <!-- Content for the second card -->
      <h3>Card 2</h3>
      <p>Content for Card 2.</p>
    </div>
  </div>

  <!-- Add more cards as needed -->

</div>
<div class="slider-controls">
  <button class="control-btn" onclick="prevSlide()">Prev</button>
  <button class="control-btn" onclick="nextSlide()">Next</button>
</div>
</div>

';

?>