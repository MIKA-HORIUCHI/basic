<?php if($max > $per): ?>
  <?php if (!$monsplit) {?>
    <ul class="pager tac">
      <?php if ($page > 1) : ?>
      <li><a href="?page=<?php echo ($page - 1); ?>"><</a></li>
      <?php endif; ?>

      <?php for ($i = $range + $nextDiff; $i > 0; $i--) : ?>
      <?php if ($page - $i < 1) continue; ?>
      <li><a href="?page=<?php echo ($page - $i); ?>"><?php echo ($page - $i); ?></a></li>
      <?php endfor; ?>

      <li class="current"><span><?php echo $page; ?></span></li>
      <?php for ($i = 1; $i <= $range + $prevDiff; $i++) : ?>
      <?php if ($page + $i > $totalPage) break; ?>
      <li><a href="?page=<?php echo ($page + $i); ?>"><?php echo ($page + $i); ?></a></li>
      <?php endfor; ?>
      <?php if ($page < $totalPage) : ?>
      <li><a href="?page=<?php echo ($page + 1); ?>">></a></li>
      <?php endif; ?>
    </ul>
  <?php } ?>
<?php endif; ?>