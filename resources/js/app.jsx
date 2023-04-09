/**
 * First we will load all of this project's JavaScript dependencies which
 * includes React and other helpers. It's a great starting point while
 * building robust, powerful web applications using React + Laravel.
 */

import './bootstrap';

import ReactDOM from 'react-dom/client';

import ReduxExample from './components/ReduxExample';
import Home from './pages/Home';
import GenerateFixtures from './pages/GenerateFixtures';
import Simulation from './pages/Simulation';
import {Provider} from "react-redux";
import store from "./store";
import React from "react";
import { BrowserRouter, Routes, Route, Link, NavLink, } from "react-router-dom";

ReactDOM.createRoot(document.getElementById('app')).render(
    <BrowserRouter>
        <Provider store={store}>
            <Routes>
                <Route path="/" element={<Home />}/>
                <Route path="/generate-fixtures" element={<GenerateFixtures />}/>
                <Route path="/simulation" element={<Simulation />}/>
            </Routes>
        </Provider>
    </BrowserRouter>
);
