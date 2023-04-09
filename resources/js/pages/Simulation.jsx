import React, {useEffect, useState} from 'react';
import { useDispatch, useSelector } from 'react-redux';
import {
    decrement,
    increment,
    incrementByAmount,
    selectFixtures,
    setFixtures,
    updateTeams,
    generateFixtures,
    // getTeams
} from "../reducers/exampleReducer";
import { FixturesService } from "../services";
import {Link} from "react-router-dom";

const Simulation = () => {
    return (
        <div className="container mt-5">
            <div className="row justify-content-center">
                <div className="col-md-12">
                    <div className="card text-center">
                        <div className="card-header"><h2>Simulation</h2></div>
                        <div className="card-body">
                            <div className="row">
                                <div className="col-md-6">
                                    <table className="table">
                                        <thead className="bg-black text-white">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col" align="left">Team</th>
                                            <th scope="col">P</th>
                                            <th scope="col">W</th>
                                            <th scope="col">L</th>
                                            <th scope="col">D</th>
                                            <th scope="col">GD</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td scope="row">1</td>
                                            <td scope="row" align="left">Arsenal</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                        </tr>
                                        <tr>
                                            <td scope="row">2</td>
                                            <td scope="row" align="left">Chelsea</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                        </tr>
                                        <tr>
                                            <td scope="row">3</td>
                                            <td scope="row" align="left">Manchester City</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                        </tr>
                                        <tr>
                                            <td scope="row">4</td>
                                            <td scope="row" align="left">Liverpool</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div className="col-md-3">
                                    <table className="table">
                                        <thead className="bg-black text-white">
                                        <tr>
                                            <th scope="col" colSpan="3">Week 1</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td scope="row" align="right">Arsenal</td>
                                            <td scope="row" align="center">-</td>
                                            <td scope="row" align="left">Chelsea</td>
                                        </tr>
                                        <tr>
                                            <td scope="row" align="right">Liverpool</td>
                                            <td scope="row" align="center">-</td>
                                            <td scope="row" align="left">Manchester City</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div className="col-md-3">
                                    <table className="table">
                                        <thead className="bg-black text-white">
                                        <tr>
                                            <th scope="col" align="left">Championship Predictions</th>
                                            <th scope="col" align="right">%</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td scope="row" align="left">Arsenal</td>
                                            <td scope="row" align="right">0</td>
                                        </tr>
                                        <tr>
                                            <td scope="row" align="left">Chelsea</td>
                                            <td scope="row" align="right">0</td>
                                        </tr>
                                        <tr>
                                            <td scope="row" align="left">Manchester City</td>
                                            <td scope="row" align="right">0</td>
                                        </tr>
                                        <tr>
                                            <td scope="row" align="left">Liverpool</td>
                                            <td scope="row" align="right">0</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <button className="btn btn-outline-primary mt-3">Play All Weeks</button>
                            <button className="btn btn-primary mt-3 mx-3">Play Next Week</button>
                            <button className="btn btn-danger mt-3">Reset Data</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default Simulation;
