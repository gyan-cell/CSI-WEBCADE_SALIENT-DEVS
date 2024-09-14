@extends(config('app.layout'))
@section('content')



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet" />

  <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
  <link rel="stylesheet" href="./css/style.css" />
  <title>Sorting visualizer</title>
  <style>
    :root {
      --primary-color: #003cff;
      --secondary-color: #003cff;
    }

    * {
      /* Below is the standard CSS code one should add to get rid of default margins and padding which most of tge HTML elements have */
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Roboto", sans-serif;
      user-select: none;
    }

    body {
      position: relative;
      min-height: 100vh;
      text-align: center;
      display: flex;
      justify-content: space-between;
      flex-direction: column;
      align-items: stretch;
    }

    /* Title CSS */
    .title {
      background-color: var(--primary-color);
      text-align: center;
      font-size: 1.2em;
      padding-block: 0.5em;
      color: #fff;
      cursor: pointer;
    }

    /* Navbar CSS */
    .navbar {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-wrap: wrap;
      gap: 0.8em;
      font-size: 16px;
      min-height: 70px;
      padding-block: 0.6em;
      background-color: var(--secondary-color);
      transition: all 0.5s cubic-bezier(0.645, 0.045, 0.355, 1);
    }

    .navbar a {
      all: unset;
      cursor: pointer;
      color: #fff;
      font-weight: bold;
      padding: 8px 10px;
      border-radius: 6px;
      transition: 0.3s;
      background-color: #24abff;
    }

    .navbar a:hover {
      background-color: transparent;
    }

    .navbar #menu {
      width: fit-content;
      outline: none;
      border: none;
      border-radius: 4px;
      padding: 6px 8px;
      background-color: #24abff;
      color: white;
    }

    .navbar>.icon {
      display: none;
    }

    #menu,
    #random,
    #start {
      cursor: pointer;
    }

    /* Center css */
    .center {
      margin: 0 auto;
      box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
      /* Added shadow to make page border free */
      height: 420px;
      width: 410px;
      max-height: 731px;
    }

    .array {
      display: flex;
      align-items: flex-start;
      min-height: 100%;
      height: 100%;
      padding: 1rem;
      flex-direction: row;
    }

    .cell {
      display: flex;
      align-items: flex-start;
      flex: 0.5;
      width: 0.000001%;
      margin: 1px;
      background-color: #d6d6d6;
      resize: horizontal;
      position: relative;
      transition: all 0.4s ease-in;
    }

    .cell.done {
      background-color: #9cec5b;
      border-color: #9cec5b;
      color: white;
      transition: all 0.4s ease-out;
    }

    .cell.visited {
      border-color: #6184d8;
      background-color: #6184d8;
      color: white;
      transition: 0.5s;
    }

    .cell.current {
      border-color: #50c5b7;
      background-color: #50c5b7;
      color: white;
      transition: all 0.4s ease-out;
    }

    .cell.min {
      background-color: #ff1493;
      border-color: #ff1493;
      color: white;
      transition: all 0.4s ease-out;
    }

    /* Footer CSS */
    .fa.fa-heart {
      color: #eb2c13;
    }

    footer {
      text-align: center;
      font-size: 18px;
      color: #2c3e50;
      padding: 1.6em;
    }

    .footer>p:nth-child(1) {
      margin-bottom: 0.6em;
    }

    .link {
      text-decoration: none;
      font-weight: bold;
      color: #ff5252;
      font-size: 20px;
    }

    @media screen and (max-width: 600px) {
      .navbar {
        gap: 0.4em;
      }

      .title {
        font-size: 17px;
      }

      .navbar *,
      .navbar a {
        font-size: 14px;
      }

      .footer {
        font-size: 18px;
      }

      a#random {
        order: 4;
      }

      a.start {
        order: 5;
      }
    }

    @media screen and (max-width: 550px) {
      .center {
        width: 95%;
      }
    }
  </style>

<body>
  <div class="nav-container">
  
    <div class="navbar" id="navbar">
      <a id="random" onclick="RenderScreen()">Generate array</a>
      <span class="options">
        <select name="select sort algorithm" id="menu" class="algo-menu">
          <option value="0">Choose algorithm</option>
          <option value="1">Bubble Sort</option>
          <option value="2">Selection Sort</option>
          <option value="3">Insertion Sort</option>
          <option value="4">Merge Sort</option>
          <option value="5">Quick Sort</option>
        </select>
      </span>
      <span class="options">
        <select name="select array size" id="menu" class="size-menu">
          <option value="5">Array size</option>
          <option value="5">5</option>
          <option value="10">10</option>
          <option value="15">15</option>
          <option value="20">20</option>
          <option value="30">30</option>
          <option value="40">40</option>
          <option value="50">50</option>
          <option value="60">60</option>
          <option value="70">70</option>
          <option value="80">80</option>
          <option value="90">90</option>
          <option value="100">100</option>
        </select>
      </span>
      <span class="options">
        <select name="speed of visualization" id="menu" class="speed-menu">
          <option value="0">Speed</option>
          <option value="0.5">0.50x</option>
          <option value="0.75">0.75x</option>
          <option value="1">1.00x</option>
          <option value="2">2.00x</option>
          <option value="4">4.00x</option>
        </select>
      </span>
      <a class="start">Sort</a>
      <a class="icon"><i class="fa fa-bars"></i></a>
    </div>
  </div>
  <div class="center">
    <div class="array"></div>
  </div>
  
  <script>
    "use strict";
    const start = async () => {
      let algoValue = Number(document.querySelector(".algo-menu").value);
      let speedValue = Number(document.querySelector(".speed-menu").value);

      if (speedValue === 0) {
        speedValue = 1;
      }
      if (algoValue === 0) {
        alert("No Algorithm Selected");
        return;
      }

      let algorithm = new sortAlgorithms(speedValue);
      if (algoValue === 1) await algorithm.BubbleSort();
      if (algoValue === 2) await algorithm.SelectionSort();
      if (algoValue === 3) await algorithm.InsertionSort();
      if (algoValue === 4) await algorithm.MergeSort();
      if (algoValue === 5) await algorithm.QuickSort();
    };

    const RenderScreen = async () => {
      let algoValue = Number(document.querySelector(".algo-menu").value);
      await RenderList();
    };

    const RenderList = async () => {
      let sizeValue = Number(document.querySelector(".size-menu").value);
      await clearScreen();

      let list = await randomList(sizeValue);
      const arrayNode = document.querySelector(".array");
      console.log(arrayNode);
      console.log(list);
      for (const element of list) {
        const node = document.createElement("div");
        node.className = "cell";
        node.setAttribute("value", String(element));
        node.style.height = `${3.8 * element}px`;
        arrayNode.appendChild(node);
      }
    };

    const RenderArray = async (sorted) => {
      let sizeValue = Number(document.querySelector(".size-menu").value);
      await clearScreen();

      let list = await randomList(sizeValue);
      if (sorted) list.sort((a, b) => a - b);

      const arrayNode = document.querySelector(".array");
      const divnode = document.createElement("div");
      divnode.className = "s-array";

      for (const element of list) {
        const dnode = document.createElement("div");
        dnode.className = "s-cell";
        dnode.innerText = element;
        divnode.appendChild(dnode);
      }
      arrayNode.appendChild(divnode);
    };

    const randomList = async (Length) => {
      let list = new Array();
      let lowerBound = 1;
      let upperBound = 100;

      for (let counter = 0; counter < Length; ++counter) {
        let randomNumber = Math.floor(
          Math.random() * (upperBound - lowerBound + 1) + lowerBound
        );
        list.push(parseInt(randomNumber));
      }
      return list;
    };

    const clearScreen = async () => {
      document.querySelector(".array").innerHTML = "";
    };

    const response = () => {
      let Navbar = document.querySelector(".navbar");
      if (Navbar.className === "navbar") {
        Navbar.className += " responsive";
      } else {
        Navbar.className = "navbar";
      }
    };

    document.querySelector(".icon").addEventListener("click", response);
    document.querySelector(".start").addEventListener("click", start);
    document.querySelector(".size-menu").addEventListener("change", RenderScreen);
    document.querySelector(".algo-menu").addEventListener("change", RenderScreen);
    window.onload = RenderScreen;

  </script>
  <script>
    "use strict";
    class Helper {
      constructor(time, list = []) {
        this.time = parseInt(400 / time);
        this.list = list;
      }

      mark = async (index) => {
        this.list[index].setAttribute("class", "cell current");
      }

      markSpl = async (index) => {
        this.list[index].setAttribute("class", "cell min");
      }

      unmark = async (index) => {
        this.list[index].setAttribute("class", "cell");
      }

      pause = async () => {
        return new Promise(resolve => {
          setTimeout(() => {
            resolve();
          }, this.time);
        });
      }

      compare = async (index1, index2) => {
        await this.pause();
        let value1 = Number(this.list[index1].getAttribute("value"));
        let value2 = Number(this.list[index2].getAttribute("value"));
        if (value1 > value2) {
          return true;
        }
        return false;
      }

      swap = async (index1, index2) => {
        await this.pause();
        let value1 = this.list[index1].getAttribute("value");
        let value2 = this.list[index2].getAttribute("value");
        this.list[index1].setAttribute("value", value2);
        this.list[index1].style.height = `${3.8 * value2}px`;
        this.list[index2].setAttribute("value", value1);
        this.list[index2].style.height = `${3.8 * value1}px`;
      }
    };

  </script>
  <script>
    "use strict";
    class sortAlgorithms {
      constructor(time) {
        this.list = document.querySelectorAll(".cell");
        this.size = this.list.length;
        this.time = time;
        this.help = new Helper(this.time, this.list);
      }

      BubbleSort = async () => {
        for (let i = 0; i < this.size - 1; ++i) {
          for (let j = 0; j < this.size - i - 1; ++j) {
            await this.help.mark(j);
            await this.help.mark(j + 1);
            if (await this.help.compare(j, j + 1)) {
              await this.help.swap(j, j + 1);
            }
            await this.help.unmark(j);
            await this.help.unmark(j + 1);
          }
          this.list[this.size - i - 1].setAttribute("class", "cell done");
        }
        this.list[0].setAttribute("class", "cell done");
      }

      InsertionSort = async () => {
        for (let i = 0; i < this.size - 1; ++i) {
          let j = i;
          while (j >= 0 && await this.help.compare(j, j + 1)) {
            await this.help.mark(j);
            await this.help.mark(j + 1);
            await this.help.pause();
            await this.help.swap(j, j + 1);
            await this.help.unmark(j);
            await this.help.unmark(j + 1);
            j -= 1;
          }
        }
        for (let counter = 0; counter < this.size; ++counter) {
          this.list[counter].setAttribute("class", "cell done");
        }
      }

      SelectionSort = async () => {
        for (let i = 0; i < this.size; ++i) {
          let minIndex = i;
          for (let j = i; j < this.size; ++j) {
            await this.help.markSpl(minIndex);
            await this.help.mark(j);
            if (await this.help.compare(minIndex, j)) {
              await this.help.unmark(minIndex);
              minIndex = j;
            }
            await this.help.unmark(j);
            await this.help.markSpl(minIndex);
          }
          await this.help.mark(minIndex);
          await this.help.mark(i);
          await this.help.pause();
          await this.help.swap(minIndex, i);
          await this.help.unmark(minIndex);
          this.list[i].setAttribute("class", "cell done");
        }
      }

      MergeSort = async () => {
        await this.MergeDivider(0, this.size - 1);
        for (let counter = 0; counter < this.size; ++counter) {
          this.list[counter].setAttribute("class", "cell done");
        }
      }

      MergeDivider = async (start, end) => {
        if (start < end) {
          let mid = start + Math.floor((end - start) / 2);
          await this.MergeDivider(start, mid);
          await this.MergeDivider(mid + 1, end);
          await this.Merge(start, mid, end);
        }
      }

      Merge = async (start, mid, end) => {
        let newList = new Array();
        let frontcounter = start;
        let midcounter = mid + 1;

        while (frontcounter <= mid && midcounter <= end) {
          let fvalue = Number(this.list[frontcounter].getAttribute("value"));
          let svalue = Number(this.list[midcounter].getAttribute("value"));
          if (fvalue >= svalue) {
            newList.push(svalue);
            ++midcounter;
          }
          else {
            newList.push(fvalue);
            ++frontcounter;
          }
        }
        while (frontcounter <= mid) {
          newList.push(Number(this.list[frontcounter].getAttribute("value")));
          ++frontcounter;
        }
        while (midcounter <= end) {
          newList.push(Number(this.list[midcounter].getAttribute("value")));
          ++midcounter;
        }

        for (let c = start; c <= end; ++c) {
          this.list[c].setAttribute("class", "cell current");
        }
        for (let c = start, point = 0; c <= end && point < newList.length;
          ++c, ++point) {
          await this.help.pause();
          this.list[c].setAttribute("value", newList[point]);
          this.list[c].style.height = `${3.5 * newList[point]}px`;
        }
        for (let c = start; c <= end; ++c) {
          this.list[c].setAttribute("class", "cell");
        }
      }

      QuickSort = async () => {
        await this.QuickDivider(0, this.size - 1);
        for (let c = 0; c < this.size; ++c) {
          this.list[c].setAttribute("class", "cell done");
        }
      }

      QuickDivider = async (start, end) => {
        if (start < end) {
          let pivot = await this.Partition(start, end);
          await this.QuickDivider(start, pivot - 1);
          await this.QuickDivider(pivot + 1, end);
        }
      }

      Partition = async (start, end) => {
        let pivot = this.list[end].getAttribute("value");
        let prev_index = start - 1;

        await this.help.markSpl(end);
        for (let c = start; c < end; ++c) {
          let currValue = Number(this.list[c].getAttribute("value"));
          await this.help.mark(c);
          if (currValue < pivot) {
            prev_index += 1;
            await this.help.mark(prev_index);
            await this.help.swap(c, prev_index);
            await this.help.unmark(prev_index);
          }
          await this.help.unmark(c);
        }
        await this.help.swap(prev_index + 1, end);
        await this.help.unmark(end);
        return prev_index + 1;
      }
    };

  </script>

@endsection
