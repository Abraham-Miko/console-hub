<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Histori Rental</title>
</head>
<body>

    {{-- NAVBAR --}}
    <nav class="w-full py-4 bg-transparent">
        <div class="container mx-auto px-6 flex justify-between items-center">
            <div href="/" class="">
                <x-main-logo/>
            </div>

            <div>
                <a href="{{ route('login') }}" class="text-gray-700 hover:text-gray-900 text-md">Log in &raquo;</a>
            </div>
        </div>
    </nav>

    <div class="bg-yellow-50 py-10 border-b border-gray-200">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800">Riwayat Peminjaman Anda</h2>
        </div>
    </div>

    <div class="container mx-auto px-4 mt-8">

        <div class="bg-white p-4 md:p-6 shadow-md rounded-lg mb-6 border border-gray-100 transition duration-300 hover:shadow-lg">
            <div class="flex items-center justify-between">

                <div class="flex items-center space-x-4 flex-1">
                    <img src="data:image/jpeg;base64,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" alt="PlayStation 5" class="w-20 h-20 object-cover rounded-md flex-shrink-0">

                    <div class="min-w-0">
                        <h4 class="text-xl font-semibold text-gray-800">PlayStation 5</h4>
                        <p class="text-sm text-gray-500 mt-1">
                            <span class="font-medium">Pinjam:</span> 20 Nov 2025
                            <span class="mx-2">|</span>
                            <span class="font-medium">Kembali:</span> 25 Nov 2025
                        </p>

                        <span class="inline-flex items-center px-3 py-1 mt-2 text-xs font-medium bg-green-100 text-green-800 rounded-full">
                            🟢 Selesai
                        </span>
                    </div>
                </div>

                <div class="text-right flex flex-col items-end space-y-2 ml-4">
                    <p class="text-sm text-gray-600">Total Biaya:</p>
                    <h4 class="text-2xl font-bold text-red-600">Rp 300.000</h4>

                    <a href="#" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 transition duration-150">
                        Detail
                    </a>
                </div>

            </div>
        </div>

        <div class="bg-white p-4 md:p-6 shadow-md rounded-lg mb-6 border border-gray-100 transition duration-300 hover:shadow-lg">
            <div class="flex items-center justify-between">

                <div class="flex items-center space-x-4 flex-1">
                    <img src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBxMQEhUQEhMVFRUXFhcVFRcXFxUXFRUYFhUWGBcaFRcYHSggGB8mGxUWITEhJSkrLi4uFx8zODMtNygtLisBCgoKDg0OFw8QGS4fHR0tNSsvLy01KzctLS83Ky03Ky0tKys1MistLTcrLTcrLS0vLy0rLS0tLjUrLS01LS0rN//AABEIAOEA4QMBIgACEQEDEQH/xAAcAAEAAQUBAQAAAAAAAAAAAAAABQEDBAYHAgj/xABKEAABAwIDBQQGBgcFBgcAAAABAAIDBBEFEiEGMUFRYQcicYETMkJikaEUI1JysfAVM4KSosHRJFNjsuEWNHODo8MIJUOzwuLx/8QAGQEBAQEBAQEAAAAAAAAAAAAAAAECAwQF/8QAKhEBAQACAQMCBQMFAAAAAAAAAAECETEDEiEyQQQTUXHwYaHhIpGxwdH/2gAMAwEAAhEDEQA/AO4oiICIiAiIgIiICIiAiKhKCqsVlZHCwySvbGwb3PcGtHmVzrbHtSZETDQhsjxoZTrE37gH6w9d3iorYzZifF3ivxGR8kIN42OOkp6NGjI/ADN4bwztrO2angvHRx/SJN2d12RDy9Z3hp4rkuNbdYlWOLpKuVo4MicYmDpZlifMlfROO7B4fWNLZKaNrrWEkbWxyt5We0a25G46Lge3GxEuFzBjjnhff0MtrZgN7Xj2XjlxGo4gUYOC7aYhSOD4quU23ske6WN3QteT8RY9V37s827ixWMtIEdQwAyRXuCN2eMne2/mDod4J+bWwqQwavlo5mVMLsr4zmB4Ebi13NpFwfFB9ZIuf0XbBhjyxr3yRlzQXF0bsjHHe1zgOB9q2XjdbzR1kczBJE9kjHatcxwc0+BGhUF9ERAREQEREBERAREQEREBERAREQEREBERBQlcV7R9vTVF1JSutTjSR43zniAf7v8AzeG+b7Wtri0HD4Hakf2hw4NO6MdSNT0IHE25dh9A+eRkMYu97g1o6nnyA1JPAAqjYOzzZI4jPd4P0eIgyndnO8Rg9ePIciQu/wAcYaA1oAAAAAFgANAABuCjdm8FZQ07KeP2RdzuL3n1nHxPwFhwUooCg9tqOmmopm1bgyINzGQ74yPVc3iSDbQb721vZTi0Ltvny4VI37csLfhK2T/toPn6WpA0br1PHyWJJITvKo5y8FULrPwXHKmif6SlmfC7jlPdd99hu1/7QKwFRB3HYTthbMTDiPo4iGktmbcMcR7Lma5XEbrGxOlhpeTxLtooIzaOOomH2msaxvl6RzXfJfPLgsqmvJZo3nRB9ZbNY7FiFOyrgzZH30cLOaWuLXNcOYIKlFzbsurWU8UdKD3bWv75JJPmSfiukpQREUBERAREQEREBERAREQEREBQW2W0DaCmdNoXnuRNPtPINr9BqT0Cl6uqZCx0sjgxjAXOcdAAN5K+etv9sjiNRmjBbDGC2IO3m/rPI4F1hpyA6oImeRz3Oe8lznEuc473OJuSfErqXY9s7Zrq+QauvHD0aDZ7/MjKOjXc1y7ZmgkrauKlbfvkhxAHcaAS550tYDXXebDivpqjpmQxsijGVjGhrQOAaLAK0XkRWqmoZG0ySOaxjRdznENa0cyToFBdXLv/ABBh/wBAhsO6KlpeeX1Uobfzd+Cs7W9rzWXioGh53GaQHJ/y2aF3ibDoQuVYris1W4vqJXyuN9XHdfg0bmjoAAroa8gC9PjymyIKWVCvRVLIPNr6BSeFtaw+8d54eA/P4LFYzL48f6BegbaoOgbN4iWuC7fs9iQniBv3m6HryK+ccKqNzgurdn1e4ytYOOhHQC/8vkqjpiIiyoiIgIiICIiAiIgIiICItc292g+gUj5Wn6131cI99wOv7IBd5dUHOu2Haz00n6Phd9XGbzEe3INzPBvH3vurmZFtVklhOpuSTck6kk7yVl4HQsqaympJL5ZZWteBvLd5F+FwDqtI6n2I7O+igfXvAL5+7Ede7CNdLj2n3vwIY0hdNXhjGsaGgBrWiwAsGtAGgHIALku33ayG5qbDnBztzqnQtb0hB0effPd5Zt4yrddsduabDBlefSTEXbCwjNruLz7Dep62BXDNqdrqnEnXnfZgN2RN0jZyNvaPvHXfaw0WvySue4ve4uc43c5xJc4neXE6k+KqCqKOVAV6svUFO6Rwjja573GzWtBc5x5Bo1KqMedlxfiFiErruzHZBNNaStf6Bu/0bMrpT952rWfxeSkcQ7Donz5oqp8cBteMszyA21DZC61jv1BsoriQF9ArwZl8ePToFNbSUsdJVT00LHMbE70Ti9xdI9txaR50AzOF7NAABb1KhUBERUZ+ETWdlO7f+fJd/wCzTZ90EX0iUWfIO6072M36jgTvtwFuq0bsd2FMzhiNSz6of7uw/wDqO/vCPsDh9o67gL9vUBFQuA4hVUBERAREQEREBERAREQFxPtdxUz1ggB7sDQ23vvAc4/DIPIrs1ZUtijfK82YxrnuPJrQST8AvmPHMZkq6iWoIDfSPLgANWt3NB5kNABPE3Vg8OsBcmy2jskw9r6mTFZyI6elDrPcbN9IWlu/3WOJPVzFpFRcNc7eQNL89w+av4vj7paeGhjuymhaLM4yy73yy83FxcQNzQRx1VRs3aJ2kyYiXU9Pmjpb2PB845yfZb7nH2uQ0MK0CrjSguNKuNK808LpHNjY0ve45WtaCXOJ4NA1JXZ9g+ylseWoxAB797ae4LG/8UjR590d0a+twitL2M2BqcRtJ+qp/wC9cPXH+E32/HQdSRZdv2Y2TpcOZlgj7xFnSu70r/vO4D3RYdFNtaALDQDQDkqqAiIg+d+0fKcYrbjQtgYfOFt/wWjTRFji07xx5jgVt+38n/mlaf8AFYP3YY1r9ZHnbmHrN+JbxHl/JURq3DYrZuF7HYliByUMJtre9TIDpGwb3C+htvPd+1avZ7sFLicjXvBZSNP1klwC+3sR8bncTw142Cv9qmLNmqfokIDaWjHoY2N0YHsFpHW6WyDllP2igkca7YaqUmOjjZTRAWaSA+Ww0HuM09kA+K1am2oqRIZ3zPkdfuuec5vzbnva3wULPRuayM2/Wa/G1h8CrraRztANG2HmRc/iEHQ8C23aGFz6Vk8v95Kc5J6lwJsL7hbeFnw9oOIx95tK30Y1IbA4Nt4B+YeJC1KjPoIWhujnXueIaCRpyu4OPgpHCMRLHDVdrjhjJ3eaxu3h1XY3b2DELR/q5vsE3D7b8jtNfdIB8bXW3LiWM4U2dv0un7k7LOdl09IBrfTc8WuD08F0bYHaT6fT9+3po7Nk96/qvA96x8w5c8sdeZw1K2dERYUREQEREBERBpva3WGLDZGg2MjmReRdmcPNrXDzXAw1do7cH/2SBvOoB+EUv9VxkBaiMfEf1Z8W/wCYKMUvXt+rd5H4EFRQag8gKQwPB5qyZtPTsL5HcNwaOLnu9lovqfAC5ICv7O4BNXztp4G3cdST6rGje554AfPQDUr6R2N2TgwyH0UQzPdYyykd+Rw58mi5s3h1JJLYj9g9goMMaH6S1BFnykbr72xD2W/M8eAG3ordTUMjaXyOaxrRdznEBoHUncsquKNxvHqeiZ6SplbGOAOrnfdaNXeQXOdse2GOPNDQASP3GZw7jfuNOrj1OnQrklfictVIZppHSPdvc43PgOQ6DRUdfxbtphaSKamfJ70jhGPEAZifOy1+ftxqWn/dISOWd4Px/wBFzYhYNag2HF8VNZPNVloYZniTKDmy3iZpmsL7uSx4n2P56rFo/U8mf5LfyV5v5+aI+hOy2vz4awkACIvYLAC7W6jQcdbX42vxXz9icpkE0jvWfncfFxJPzK732WQXwhg4vM//ALsjR+AXB62Huv6gkeYuPxRUviQDnwtA0a5vkvWCQ6P09v8A7caxWYoxoaSeR8FsVDRZM1yNTcdAAB/JVEBUyer9wfn4qzHUWK94ozI4t5Oc355h/C4KOL1vqX+raY8N32exfKQLqb2eqxR4hG9ukczhE4cLSkZPhJl8rrndBU2IWwVtUTFnB7zRcHq3VvzTHzLCvoRFAf7Ss6fFVXJpPIiICIiAtT7QttY8KhBsHzyXEUd9NN7321DRcdSSBpqRti+Zu1fEnVGJzknSNwhZ0bELH/qGU+aCNrscqK2f0tTK6R5BAvo1g32jaNGjTcN/G51XprVEUjrOaeo+einmsWkWpIszS3mCPiFjbOYLNXzNp4GZnu1J3NY3S7nn2Wj/AEFyQFJtarmyeN/QJKoRuLKiRoiiOmRsbjne+99XjK1rRbiTruQdMmxSh2ZpvQR2nqnDM8AgPe63rSnX0TBrZup10BOYrmeN9pmJ1pLWzegYdzYAWEjhd9y8nwICgsUmjdfM9ziTmdl1Lj1edN+p3rGZJJJpEzKN3d/m8/1TSpmk2nqqY3NTJm32Li958SdG/nRYe0W1tXXkenmc5o9Vl7NHWw3nqrVPgTj67gOg1Px3D5rOFJFCNGgu5u1t4X0v4IjWbq7HLZSk8t9FY+ih3C3girAqCeCw6iW5UhPDkabqMawuOUakqCXoj3B4N/y3/mr7QrdOywt1/Cw/kr7B+fgqjduyrbD6FUmmld/Z5nAa7opTYB3QO0afI6WK1HbiJ9NXVNMdMkrsv3HWdH/A5qg6yY53NH5uAtxdTy1sbaqoIM0cLIW2BzPbHmtJKTvfZ1vIE6orSizgVv8AhGLh8DHE94DK77zdCfPQ+a0mtisVSjqSw2vo78UGzYpIJXXG8gDzHq/jbzaoZy8GfVSNMxlRpnbHJzebMd953sn3joeJB369U17s8MOF1ip5ryYHHxA6nKf6j4q/SbB1ru+WMZHvMhliLLcwWuN/JbBsVgP0urYxutPTuD5HcHOaczW34lzgCQNzRblfeM7Jcqlu/De/9lnotzRcGxERAREQF8nbVG9ZO46gz1BPO30qbcvrFfJ20sD31U2RjnfW1G4af71PvO75qiw1kVrZh43sfmpmKRpAdcW5/jZQsOCv3vIaOQ7zvlp8LqX/AEfGWi4kJI7rGWAHIG+pPQA+PBVHibEmN0vc8goSvkEjxIWGwFiL2vvtz5qViwmU6BmQX9ru/Ebz8FdZgchvmytG67iLHw4/FApKCIRemyg7gBvueQCkIhdoJGXTdy8VdwengidaZz5WgCwjs3yN+HUEKXZtnQQPsaAOa3d3mPJPN2cXd4ZrKjW6ioAGn/6oeecuK6RHV4ZirsjYmRSO3NyiGS55FndeegJ8FE7R9nM9Kw1EV5oRq7T6yMc3ges33hu4gAXQaXHHdZIFlW1grbig8ztDgWncsTDoB3supuQXHdb3V7r58jTzOgVcFEjx3W6cSTZv9T5BQZFrLxJNbQandYb9FlzU3DMfKw/G68sha0aDxPE+JQYDYbEvPrH5fmy2XZqvscp3FQcjVWieWuvuA1JO4Dr+bnggzNpqMROJPqnVvW/JawH66+S+idi8Co8TwtpmiziUvDi7R7TFI9jSxw1ZuuLH2je60faPsXqoiTRvbUR8GvLY5h01sx3jdvgornUbSRYi/wCI8F7Ywg318t/w3rZKPs1xcuyClcwc3yQZR5h5Pwut1wDsXkzB9ZUNtxZE3NfpneAB+6UHN8Jw+oq5RDA27nc23Pja3zNh1X0hsZs/+j6VkBdnf60jrAXcd9gNwG4f6qQwnCIKRgigiZG0cGtAv1cRvPUrNTYIiKAiIgKK2gx+GiZmkN3H1Ixq956DgOp0UXtPtc2nJp6dvpqg+y0FwZ1eG6k+6POy57XYfI55nr5xE46kEh87hwDI2eqPgByVkFMW27q6iV0LZHR+5FpbkPSDvE+B8go12ESt707XRgjN3+6466kh2o8SFebi5ZeOhjMQPrSaOqJOr5PZ8G2tzVlmCzTHNJqd93Eud8T/AFV0jDrnRCN7IzmeWkAt1sSN4edPMbuSz49opgMtPFHTX3iJoLz0dI4FzvHRSVLsy0auuVKQ0EcY0AC1oa9N9JqTcsazQagEE24kkk381kUuy4Osjifz8VKTYtBFvePBuv4blZbjMr/1MDiODnWa3yJ0PxXXHo53zIzc5FjFsMihiIa0XPHitD/QGdxs63ktuxj6S/8AWTRsHJgLreO78SoWOCS/drNeTmEj5uP4K3oX9P7xO+IqXBXRGzhp8iun7A7auhyU1U8viNmslcbujO4NkcdXMO7MdWnfcG7dRmqahrLTxsmj/vIfXb1LDa/ksSmbnLWMs5ryGgn1AC4Zi82u1obnvodbCyz8jK3S98TvalsgKZ5rKdtoHm0jBuieToRyY48OB03EAc9K7Zs1iBc1+F1gzuY1zG59RLEBYtcT6zmgjU6uaQdSHFcs2wwB1DOYrkxuu6Jx9pvI+824B8jxCxcbPFXaJwTZ+XEHuMbbtZzOVo32zHrY2A32PBZrqSWkk9FMwtO9u4hzd3dI0I/Bbx2VMAo3Ab/SAnwMMX/yz/NZu3eHCWle+3fhBlaeWQXePNgI8bHgppXPahqxrq/BJnaovEazL3GG7z55epWR7qZQ3fv5cVhSSl3hwHD/AFPVeLL3DC57mxsBc97gxjRvc5xAaB4kgKD6H7FoyMJhJ9p85Hh6Z4/kt5Ubs5hYo6WClBv6KNrCftEDvO8zc+aklFEREBERAREQUcbanQLRMf7QIu9FTtfMdxc0ljT91w73mB4FZW1Va6pe+jYSI2WExGhe4gHJfkAQTzvbgbw7KKCnGuVvjYX/AKreOO02g2y1koyMy00Z3tiGS/Vzh3ifFy90my7Bq+7jvN+JUm7F2k5YY3SHoLDzO9eS2d/ryNiHJved/T5herH4XO+b4+7nepPbyuNpYohrlaOtgrLsTZfLG10juTQT+fJUbTQMNyHSO5vcT8AP5kr3JiJAyts1vJoDR8At9nRw9V39vz/id2d4mlqRtS7gyEe+bu+AuR5hYkuHsOssr5Ty9Vvw1v5WVZam/FYslQl+Jxx9GMn5+p8u3msqP0cf6uNretru/edc/NUkrCdSVGSVKxJKpcM+tnnzW5hJwri017rUa2YtNwVOVc11r9dquW2tM/DcbcNCVnx1GV3pG8TdwHHqBz/HcVqF7FStFV6WXTpda4XbGWO46a5v0qBlRG600OU5hvyt9V3XLuN97TY8QsnFomYrRlpAZK06f4crRz+w4H91w4jTTdl8eNNKNe6Tu4a7wRxB108eamfp/oJBUtBEMhIPG7Ad45mMu+BcLahfT6uGPV6dzx9vyxwwyuOWq1rY/aD9HTuinBaxxLHjiwhxN7DeWuL9BvDja5AB3banaKm+iSiOaOR8jHRsaxzXO74LbuAN2gAk623W3rVu0DCwT9KYAQbNlGhB4Mf14NP7PVamZ4w3uRBruLs73D9lrvVXyb4emPLjlGW+nLn49Oix3sv3uO7y/P4r2Fl4JhctbUNpadodI8G1yGtAaLkuPAD4+KxVRx01XYux/YNzHNxKqYWm39njcLEXFjK8HcbEho6k8rT2xvZbT0ZbNUEVE4sRcfUxkG4LGH1iNO87lcBq6CooiIoCIiAiIgIiIOPiWd9TUx+k9E0VE1za73fWu3dLWA1HmsqOgiabkGR3N5v8tB8Qq9pFO6jrGVY/VVADHHg2Vg0v95g/gco9uIBwvdeudbtk7PDn2b5Sj6mwsNByGg+CxZKhR8lYsSSrXK5281qSRIyVCxZKpR0lSsd86ztWdLVLFkqFiPmVoOLiGtBJO4AXJ8AFNi++oWO+VXRRPsS4tjAbmJedQMwZctaC4d5wGo5q5iWFmFmYuBILQ4aAjMHA6X4Oa5txofIqCOleo+oCynPWPKgiqhitwyWKy52rCeLKCTZLcLOZiTwASS62lvH7PIO49bHgoOCRZbHc93HqOP8AVev4br3C69q59TDbecCq2yxmndq3J3OGaI6FvTKSB0BbyK0vE6EwSuiOtjoftNPqn4fO6lcFa5jczSS9ry4C4ynSxbzGYZrk/auN1zLbWUjZqdtWz2QL8CWPItccwSNOF3Llnrd03OGkSuyhdn7DtkjDGcSmFpJm5YQfZiuCXeLiB5Ac1zrs82XOK1gY4H0EdnznmL6M8XEW8AV9MxsDQGtAAAAAGgAG4Bcar0iIooiIgIiICIiAiIgjNpMFjrqaSll3PGjhvY4ase3qHAHyXz6wy00slLOLSROLHDgbbnDoQQR0IX0quZ9seypljGIwNvLC20zQNZIRc36llyfAu5BWUaJ6e6tvlUbSVeYK+Xqoul91cFK4g6gHkd+8gfMW47wsJz1Q1BNgSSALWvwve3xWcpleKzlL7JiOKmaxsjiToO6Xd9zhq4ZR6o0c25vqW671cdizW6RwtOhF3BrGnXUlp9YHPILbwHi3FQL6r7IDfAa/FY8kxO83VaS0uKOzXzNZy9GBmDTrlDzqBck23a8rWip5cxvcnnmNzc6k36m581ZL14c9Uey5eHOVsyLwXoDwsOViyS9W3FBhjRZsTtFiyBVhcbpBPYRU5XgHcdPNv/1sr+0FdKA2hiaXemeHMaLXJkdYsH7YLv8AmKAqHkWsdQb+B0/our9iey75XHFakE2u2lDhpro+Vo4D2R+0eRXTqeMrEx4dC2A2WbhlIyAWMh78zx7UhGvkNAOgWyIi4tCIiAiIgIiICIiAiIgKhCIg+fO0jZQ4XU+kiFqWZxMdt0T97oj03lvS49nWAZNcL6Tx7B4q2CSmnbdjxY82ne1zTwcDYg9F82Y1hEuHVD6Sf1m6teBZsrD6r2+NtRwII4KwHSK06RWHzLHfMqjLdKrTplhunVt0yDMdMrTplimRZFPQTSasje4c8py/vbgrjhll4xm0tk5eTMvBlWX+iXDWSSJni/MfhHmXqnpIXOyMM07/ALMTNflmPyXT5GU9Wp97/rlO+ezA9IgJOg1W6YZsJXz29Fh5YD7dQ7JbxY43/gW2YZ2Q1TrfSKuOIcWQMLv4nZQP3Sp29Oc5b+386N36OSijed4yj3tPlvV2GIXDGd953AC5P3QF3zC+ybDobGRstQ4cZZDb92PK0+YK3DDcKgpm5IIY4m8o2NYPPKNVPmSemL275cS2J7Lpqp7ZaxjoqcEOLHgtlm45cu+NnMuseAGuYd2hiaxoY0BrWgBoAsAALAADcF7ui52tCIigIiICIiAiIgIiICIiC3mTMsXOV5Lygy8617bTZSDFIRHL3ZG3MUrR34yd/wB5psLt42G4gESpkKpnKD5v2k2RrMPfkmZdt7Mlb+rfysTuPunX8VCmjf7WVo5uc0fzX1S55ILSAQd4IuD5FRzMFpWnM2lpw7mIYgfiGrpMsPefuzq/V83UWGCU2Y58p+zBFJMfPKNFstBsDWSWyYfNY+1PIyFo6lpLX/IrvbXWFhoOQ0HwTMVr52vTjJ+/+dnb9a5Vh/ZdWn1paOm/4bHTPH7RDT/Epyn7JYHEGprKqc8gWxtPyLh+8t6zFMx5rOXWzy8W0mMnsg8P7PcLg9WjjeecxdMf+qXD4LZqaOOJuWNjWN5NAaPgFjXPNV15rm0zfSp6RYWvNVseaDMzpnWIA7mvQvzQZWdMyxtVXVBk5kzLH1VdUF/MmZWLlVuUF/Ml1ZuUuUF66XVm5VblBdul1aul0F26K3dEGOqFVRBQryiIKFeSiICBEQVREQVCqFVEAKqqiAqoiCqqERB6CIiCqKqICIiCqIiAiqiAiIg//9k=" alt="VR Headset" class="w-20 h-20 object-cover rounded-md flex-shrink-0">

                    <div class="min-w-0">
                        <h4 class="text-xl font-semibold text-gray-800">VR Headset</h4>
                        <p class="text-sm text-gray-500 mt-1">
                            <span class="font-medium">Pinjam:</span> 26 Nov 2025
                            <span class="mx-2">|</span>
                            <span class="font-medium">Kembali:</span> 30 Nov 2025
                        </p>

                        <span class="inline-flex items-center px-3 py-1 mt-2 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">
                            🔵 Sedang Dipinjam
                        </span>
                    </div>
                </div>

                <div class="text-right flex flex-col items-end space-y-2 ml-4">
                    <p class="text-sm text-gray-600">Total Biaya:</p>
                    <h4 class="text-2xl font-bold text-red-600">Rp 260.000</h4>

                    <a href="#" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 transition duration-150">
                        Detail
                    </a>
                </div>

            </div>
        </div>

    </div>

</body>
</html>
