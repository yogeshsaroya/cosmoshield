<?php $this->assign('title', 'Knowledge Base | ' . env('APP_NAME')); ?>


<main class="pb-12">
  <div class="bg-dark-sec pb-12">
    <div class="container">
      <h2 class="text-white mb-4"><strong>Frequently asked questions</strong></h2>

    </div>
  </div>

  <div class="container  mt--140">
    <div class="card  m-auto">
      <div class="card-body ">
        <h4 class="card-title mb-2">What is the Cosmoshield Recovery service?</h4>
        <p>At Cosmoshield, we operate a recovery service to retrieve (part of) a user’s funds. We operate based on token unbonding/unlocking times to programmatically extract the remaining tokens from a compromised wallet.</p>
      </div>
    </div>
    <div class="card   m-auto mt-3">
      <div class="card-body link-inherit">
        <h4 class="card-title mb-2">How does the Cosmoshield Recovery service work?</h4>

        <p class="text-gray-800">
          You will need to make an account to enroll in our recovery service. This will unlock the ‘Contact’ tab, where you can access a private chat with us. We ask that ALL communication be handled through this portal for confidentiality.
          <br><br>
          After enrollment, we will ask for proof that the address truly belongs to you. The easiest way to prove an address belongs to you is with a withdrawal receipt (screenshot) from a centralized exchange, showing the wallet you withdrew to or an adjacent wallet.
        </p>
        <ul class="list-disc ml-4 mt-2">
          <li>
            If multiple wallets are involved in the transfer, we will ask for bridged transaction receipts or other forms of evidence.
          </li>
          <li>
            The exchange withdrawal receipt must be of a deposit to your wallet at least two weeks prior to the unbonding event. Any deposits older than two weeks will be subject to additional review.
          </li>
        </ul>
        <p class="text-gray-800">
          After verification, we will ask for your seed phrase or private key. We understand that you should never give out your seed phrase; however, the wallet is already compromised, which means the attacker already has your seed phrase or private key.
          <br><br>
        <p class="text-italic" style="color: #000;">
          If you are uncomfortable with providing your seed phrase or private key, then we will not be able to perform the recovery. This is because your seed phrase or private key is the ONLY way for us to access the wallet, and the attacker already has it.
        </p>
        </p>
      </div>
    </div>
    <!-- end of card -->
    <div class="p-4 rounded bg-white mt-4 ">
      <h3 class="font-semibold">Registrant information</h3>
      <div class="mt-4">
        <div class="">
          <div class="flex flex-col">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
              <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 rounded">
                  <table class="min-w-full divide-y divide-gray-300">
                    <thead class="bg-gray-50">
                      <tr>
                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                          Attribute
                        </th>
                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                          Value
                        </th>
                      </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                      <tr>
                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                          Registrant Organization
                        </td>
                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                          Google LLC
                        </td>
                      </tr>
                      <tr>
                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                          Registrant State/Province
                        </td>
                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                          CA
                        </td>
                      </tr>
                      <tr>
                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                          Registrant Country
                        </td>
                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                          US
                        </td>
                      </tr>
                      <tr>
                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                          Registrant Email
                        </td>
                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                          Select Request Email Form at https
                        </td>
                      </tr>


                      <!-- More people... -->
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="card m-auto mt-3">
      <div class="card-body ">
        <h4 class="card-title mb-2">What should I do while I wait?</h4>

        <p class="text-gray-800">We recommend doing a few things while you wait for Cosmoshield to perform the recovery:</p>
        <ol class="list-decimal ml-6 mt-2">
          <li>
            Ensure that you are using official browser extensions, and remove any unknown or outdated extensions. You can download <a href="https://www.keplr.app/download" class="text-blue-500">Keplr</a> and <a href="https://metamask.io/download/" class="text-blue-500">Metamask</a> by pressing them here.
          </li>
          <li>
            Do not save the seed phrase digitally when you create a new wallet. Wallets with a digitally stored seed phrase are susceptible to malware, phishing, and other forms of digital attacks.
            <br><br>
            If you have access to a safe or safety deposit box, it may be wise to store it there, where it will never be accessed unless it's an emergency.
          </li>
          <li>
            We HIGHLY recommend using a hardware wallet, such as a Ledger. Ledger devices are known for their compatibility with many different networks. You can purchase one through our referral link <a href="https://shop.ledger.com/?r=5b8d79f5734a" class="text-blue-500">here</a>!
          </li>
          <li>
            Lastly, you can learn how to stay aware and proactively avoid scams! We release bi-weekly Medium articles discussing common scams, techniques to avoid them, and tips for protecting yourself online! You can read more at <a href="https://blog.cosmoshield.org/" class="text-blue-500">https://blog.cosmoshield.org/</a>
          </li>
        </ol>
      </div>
    </div>
    <!-- end of card -->

    <div class="card m-auto mt-3">
      <div class="card-body ">
        <h4 class="card-title mb-2">Does Cosmoshield charge a fee?</h4>
        <p class="text-gray-800">We charge a 10% commission based on each recovery we perform. This means you will always receive 90% of the recovered amount.*
          <span class="text-italic" style="color: #000;">* We cannot ensure the complete success of our recoveries. If we are less than 80% successful in your recovery, you will receive 100% of the recovered balance with no commission charged.</span>
        </p>
      </div>
    </div>
  </div>

</main>