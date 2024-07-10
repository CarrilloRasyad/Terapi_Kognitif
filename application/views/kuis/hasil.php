<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <h2>Hasil Kuis</h2>
                </div>
                <div class="card-body">
                    <div class="text-center mt-4">
                        <h2>Skor Anda: <?= $score ?> dari <?= QUIZ_LIMIT ?> soal</h2>
                    </div>

                    <ul class="list-group mt-4">
                        <?php foreach ($user_answered as $index => $answered) { ?>
                            <li class="list-group-item">
                                <h5>Pertanyaan <?= $index + 1 ?>:</h5>
                                <img src="<?= base_url('assets/quizimg/'.$answered['image']); ?>" alt="Question Image" class="img-fluid mb-2">
                                <p>Jawaban Benar: <?= ucfirst($answered['correct_answer']) ?></p>
                                <p>Jawaban Anda: <?= isset($answered['user_answer']) ? ucfirst($answered['user_answer']) : "Belum dijawab" ?></p>
                            </li>
                        <?php } ?>
                    </ul>

                    <div class="text-center mt-4">
                        <a href="<?= site_url('kuis1/restart'); ?>" class="btn btn-primary">Ulangi Kuis</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
