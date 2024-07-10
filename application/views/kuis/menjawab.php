
    <div class="container">
        <div class="text-center mt-5">
            <h2 class="font-weight-thin mb-3">Silahkan Jawab Gambar di Bawah ini</h2>
        </div>
        <div id="quiz-container">
            <div id="question-container">
                <?php  
                if ($this->session->has_userdata('random_questions')): 
                    $random_questions = $this->session->userdata('random_questions');
                    $quiz_index = $this->session->userdata('quiz_index');
                    $pertanyaan = $random_questions[$quiz_index];
                ?>
                    <?php 
                        // foreach ($this->session->userdata('random_questions') as $index => $pertanyaan):
                        ?>
                            <div class="card mx-auto mb-3" style="max-width: 18rem;">
                            <img src="<?= base_url('assets/quizimg/'.$pertanyaan['image']) ?>" alt="Question Image">
                            </div>
                            <form action="<?= site_url('kuis1/answer') ?>" method="post">
                                <input type="hidden" name="pertanyaan_id" value="<?= $pertanyaan['id'] ?>">
                                <div class="text-center">
                                    <label for="answer" class="mb-2">Gambar apakah ini?</label>
                                    <div class="input-group mb-3" style="max-width: 18rem; margin: 0 auto;">
                                    <input type="text" id="answer" name="user_answer" class="form-control" aria-describedby="answer-btn-addon" required autocomplete="off" autofocus>
                                        <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit" name="submit" value="<?= $this->session->userdata('quiz_index') >= (QUIZ_LIMIT - 1) ? "finish" : "next" ?>">Jawab</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                    <?php 
                // endforeach; 
                ?>
                <?php else: ?>
                    <p>Selamat! Anda telah menjawab semua pertanyaan.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
