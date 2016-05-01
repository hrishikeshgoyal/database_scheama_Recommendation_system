<?php
?>

<script>


var x = new Array(10);
for (var i = 0; i < 10; i++) {
  x[i] = new Array(20);
}
x[5][12] = 3.0;
document.writeln (x[5][12]);
</script>