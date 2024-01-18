  @if(!empty($faqs))
    <div class="container my-4 faq-container" id="faqs">
        <div class="card-header bg-transparent border-0">
          <h3 class="font-22 font-weight-bold mb-0"><span class="text-theme-contrast pr-2">FAQ</span>Frequently Asked Question</h3>
        </div>
        @foreach ($faqs as $key => $faq )
          <div class="card border-0">
            <div class="card-body py-0 px-2">
                @foreach ($faq['items'] as $key_faq => $faqItem)
                  <div class="card mb-1 question-box" id="question_box_{{ $key_faq }}">
                    <div class="card-header text-white bg-theme-contrast">{{ !empty($faqItem['question']) ? $faqItem['question'] : ''}}</div>
                    <div class="card-body">{{ !empty($faqItem['answer']) ? $faqItem['answer'] : ''}}</div>
                  </div>
                @endforeach
            </div>
          </div>
        @endforeach
    </div>
  @endif