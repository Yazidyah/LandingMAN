<x-layout>
<div class="container mx-auto pt-5 px-4">
        <div class="my-4 bg-tertiary rounded-lg text-white text-center py-8 leading-tight">
            <h2 class="font-bold text-3xl md:text-4xl ">Selamat Datang di Website FAQ MAN 1 Kota Bogor</h2>
        </div>

        
        <div class="my-8" id="accordion-collapse" data-accordion="accordion-collapse">
        @foreach($news as $faq)
  <div class="hover:text-tertiary my-2" id="accordion-collapse-heading-{{ $faq->id }}">
    <button type="button" class="flex items-center justify-between w-full p-5 font-medium rtl:text-right border border-b-0 border-tertiary rounded-t-xl focus:ring-2 focus:ring-tertiary  hover:bg-secondary hover:text-tertiary text-white bg-tertiary gap-3" data-accordion-target="#accordion-collapse-body-{{ $faq->id }}" data-accordion-target="#accordion-collapse-body-{{ $faq->id }}" aria-expanded="false" aria-controls="accordion-collapse-body-{{ $faq->id }}">
      <span class="text-white">{{ $faq->question }}</span>
      <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
      </svg>
    </button>
  </div>
  <div id="accordion-collapse-body-{{ $faq->id }}" class="hidden" >
    <div class="p-5 border border-b-0 border-gray-200  ">
      <p class="mb-2 text-black ">{{ $faq->answer }}</p>
      </div>
  </div>
  @endforeach
</div>


    </div>
    <script>
        const accordionElement = document.getElementById('accordion-collapse');  

// create an array of objects with the id, trigger element (eg. button), and the content element
const accordionItems = [
    {
        id: 'accordion-heading-{{ $faq->id }}',
        triggerEl: document.querySelector('#accordion-heading-{{ $faq->id }}'),
        targetEl: document.querySelector('#accordion-body-{{ $faq->id }}'),
        active: true
    },
];

// options with default values
const options = {
    alwaysOpen: true,
    activeClasses: 'bg-secondary text-black text-tertiary',
    inactiveClasses: 'text-tertiary ',
    onOpen: (item) => {
        console.log('accordion item has been shown');
        console.log(item);
    },
    onClose: (item) => {
        console.log('accordion item has been hidden');
        console.log(item);
    },
    onToggle: (item) => {
        console.log('accordion item has been toggled');
        console.log(item);
    },
};

// instance options object
const instanceOptions = {
    id: 'collapse',
    override: true
};
    </script>
    
    </x-layout>