[//]: # (TITLE: Will AI Replace Computer Programmers?)
[//]: # (DATE: 2025-01-21)
[//]: # (TAGS: Artificial Intelligence, Large Language Models, Software Development, Coding Assistants, Future Technology)

Some time ago in the Dutch news there was a headline called:
"AI leads to declining turnover among translators: 'Rates are plummeting'".
The article describes how professional translators are losing their job because of recent advancements in AI. The Large-Language models (LLMs), for example ChatGPT from OpenAI, make anybody able to make a decent translation.

Will something similar happen for computer programmers?

</br>
</br>
</br>
</br>
</br>

For a while I've been wanting to write on what the implications could be for the software industry for ever more powerful AI, but I quickly found out I'm in over my head. AI has become horrendously complicated. So much so that nobody knows how the state-of-the-art models actually work, not even their creators [1].

What is true in this space is quickly changing, and, as it is right now, nobody knows what is true or not. I think the best I can do is express hopes for the future.

My hope for the future of AI in coding is that these models are excellent coding assistants. Over time they will likely become ever more helpful. Right now the models are able to relieve the programmer from any repetitive work. For example, in my work I have been using ChatGPT to generate SQL tables, or generate tests given a class. Sometimes even giving ChatGPT complete interfaces and just ask it to generate a new instance with certain specifications gives nice results. True, we still have to tweak the code here and there, but I can say that using these models correctly can speed up a lot of repetitive programming work by a lot. Probably soon most developers will be using some sort of AI assistant for coding.

This is not where these models will stop.
Likely in some future iteration we will have models that, given some clearly formatted prompt, are able to generate software packages complete with files and tests. Maybe, in the future, many people that code now will, with the help of AI, become more of a software architect. These modern architects will perhaps be able to instruct an AI or even a group of AIs to make complex systems, given guidance. Next-generation models show this capability is perhaps going to be there faster than one might think.

However, I believe it is not a good idea to leave AI models in charge to create business-critical software without human supervision. One of the main reasons for this is the unpredictable nature of the model's output: There is currently no guarantee that giving a certain input to an LLM will deterministically result in a certain output. As the number of parameters for LLMs go from billions to trillions to quadrillions, I think it unlikely that the unpredictable nature of these models will change quickly. This is especially true for closed-source models that currently dominate the landscape. Only by poking some API are we able to guess what a model will return on a given day.

Another reason I believe it unwise to leave AI in charge of software projects without human supervision is that LLMs are currently very poorly understood. Yes, it is true that it is relatively straightforward nowadays to code your own LLM, given that all libraries that are needed are open source. But there is nobody that can actually explain why or how an LLM makes certain generalizations. There is nobody that can really explain why they actually work.

There is a scientific field dedicated to understanding neural networks and LLMs called "Mechanistic Interpretability." You can find an interesting video on it here [2]. It is amazing that with all the smart people around, there is now software out there that nobody understands, and millions of people use it every day. Let's hope the people at the mechanistic interpretability groups know what they are doing.

As the capabilities of AI in the software engineering space increase, there is going to be a need for constant benchmarking. Many businesses use these models now as-is without checking on a daily basis if the performance of a model has, in any way, changed or degraded over time. Checking the stability of these models is imperative because it will help keep businesses stable. Just like other software, these models will fail in unpredictable ways.

As stated before, I believe that AI has the potential to make a single coder much, much more efficient. But does that mean we will need fewer people that are able to code? The demand for new software, as the world works right now, is currently still increasing, and every year the number of developers grows. I don't see this trend ending very soon. Likely AI is going to fuel a productivity boost in the software space, enabling programmers to solve ever more and complicated challenges.

Having said that, I do believe that a human + AI system will always outperform a human-only or AI-only system. Several studies have shown that this combination does yield better results, and I'm optimistic about the possibilities of using AI to make working as a coder more efficient. I'm generally optimistic about this technology. I'm a fan of Arthur C. Clarke's work, and he was also known as a technological optimist. However, there are some lessons in his work we can take before we let our HAL9000 of the future take control over our spaceships.

References:
[1] Arxiv. (2021). On the Opportunities and Risks of Foundation Models (arXiv:2108.07258). https://arxiv.org/abs/2108.07258
[2] Mechanistic Interpretability video: https://www.youtube.com/watch?v=YpFaPKOeNME